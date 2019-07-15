<?php

namespace App\Http\Controllers\Admin;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Export\ExcelExport;

class AdminController extends Controller
{
    /**
     * Current model name
     *
     * @var string
     */
    protected $model;

    /**
     * Model Instance
     *
     * @var BaseModel
     */
    protected $modelInstance;

    /**
     * AdminController constructor.
     *
     * @param Request $request
     * @param Route $route
     */
    public function __construct(Request $request, Route $route)
    {
        $className = '';
        $modelName = $request->module;

        if (strpos($route->action['as'], 'admin_translations') === 0) {
            $modelName = 'translations';
        }

        $cache = explode('_', $modelName);
        if (count($cache) > 1) {
            foreach($cache as $name) {
                $className .= ucfirst(Str::singular($name));
            }
        } else {
            $className = ucfirst(Str::singular($modelName));
        }


        $modelClass = 'App\\Models\\' . $className;
        $this->model = $modelClass;
        $this->modelInstance = new $modelClass();

        $this->modelInstance->initializeAdminList();
        $this->modelInstance->initializeAdminForm();
        $this->modelInstance->initializeAdminCustomActions();

        parent::__construct($request, $route);
    }

    /**
     * Module // View all
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $module)
    {
        /**
         * Get Data From DB
         */
        $instance = $this->modelInstance;
        $filter = $request->filter;
        $search_query = $request->q;
        $date_start = $request->date_start;
        $date_end = $request->date_end;

        $items = $instance->newQuery();

        if ($function = $instance->getListCondition()) {
            $items = $function($items);
        }

        if (is_array($filter)) {
            adminApplyQueryFilters($items, $filter);
        }

        if ($date_start && $date_end) {
            $items->where('created_at', '>=', $date_start.' 00:00:00')
                ->where('created_at', '<=', $date_end.' 23:59:59');
        }

        if ($search_query) {
            $items->where(function($query) use ($instance, $search_query) {
                foreach($instance->getSearchAttributes() as $key => $attribute) {
                    if ($key === 0) {
                        $query->where($attribute, 'like', '%'.$search_query.'%');
                    } else {
                        $query->orWhere($attribute, 'like', '%'.$search_query.'%');
                    }
                }
            });
        }

        if ($request->order && $request->dir) {
            $items->orderBy($request->order, $request->dir);
        } else {
            $items->orderBy($instance->getOrderAttribute(), $instance->getOrderDirection());
        }

        if ($request->limit) {
            $data = $items->paginate($request->limit);
        } else {
            $data = $items->paginate(config('admin.module_pagination'));
        }

        $data->appends($request->except('page'));

        /**
         * RENDER VIEW
         */

        return view('admin.modules.index', [
            'data' => $data,
            'request' => $request->all(),
            'instance' => $instance,
            'search_query' => $search_query,
            'module_name' => $module,
        ]);
    }

    public function show(Request $request, $module, $item)
    {
        //
    }

    public function create(Request $request, $module)
    {
        $instance = $this->modelInstance;
        $view = $instance->getCustomFormView() ?? 'admin.modules.form';

        return view($view, [
            'state' => 'create',
            'request' => $request->all(),
            'instance' => $this->modelInstance,
            'module_name' => $module,
        ]);
    }

    public function edit(Request $request, $module, $id)
    {
        $instance = $this->modelInstance;
        $item = $instance::findOrFail($id);
        $view = $instance->getCustomFormView() ?? 'admin.modules.form';

        // Get previous and next records
        $previous_id = $instance::where('id', '<', $item->id)
            ->max('id');

        $next_id = $instance::where('id', '>', $item->id)
            ->min('id');

        return view($view, [
            'state' => 'edit',
            'item' => $item,
            'request' => $request->all(),
            'instance' => $this->modelInstance,
            'module_name' => $module,
            'previous_id' => $previous_id,
            'next_id' => $next_id,
        ]);
    }

    public function store(Request $request, $module)
    {
        $item = $this->modelInstance::create($request->all());

        $this->modelInstance->callbackAfterCreate($request, $item);

        return redirect()->action('Admin\AdminController@index', ['module' => $request->module])->with('message', 'Новая запись успешно создана');
    }

    public function update(Request $request, $module, $id)
    {
        $item = $this->modelInstance::findOrFail($id);

        // FOR PASSWORD FIELDS
        if ($item->password) {
            $old_password = $item->password;
        }

        $item->fill($request->all());

        // FOR PASSWORD FIELDS
        if ($module == 'users') {
            if ($item->password && $item->password != $old_password) {
                $item->password = \Hash::make($item->password);
            } else {
                $item->password = $old_password;
            }
        }

        $item->save();

        $this->modelInstance->callbackAfterEdit($request, $item);

        if ($request->__referer) {
            return redirect()->to($request->__referer)->with('message', 'Запись успешно обновлена');
        } else {
            return back()->with('message', 'Запись успешно обновлена');
        }

    }

    public function destroy(Request $request, $module, $id)
    {
        $item = $this->modelInstance::findOrFail($id)->delete();
        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function active(Request $request, $module, $id)
    {
        $item = $this->modelInstance::findOrFail($id);
        $item->is_active = $request->active == 'true' ? 1 : 0;
        $item->save();
    }

    public function massive_destroy(Request $request, $module)
    {
        $ids = $request->arr_rows_id;
        $item = $this->modelInstance::whereIn('id', $ids)->delete();
        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function custom_form(Request $request, $module, $id, $action)
    {
        $item = $this->modelInstance::findOrFail($id);
        $action_interface = $this->modelInstance->getCustomAction($action);

        // Get previous and next records
        $previous_id = $this->modelInstance::where('id', '<', $item->id)
            ->max('id');

        $next_id = $this->modelInstance::where('id', '>', $item->id)
            ->min('id');

        return view('admin.custom_forms.' . $module . '.' . $action, [
            'item' => $item,
            'action_interface' => $action_interface,
            'request' => $request->all(),
            'instance' => $this->modelInstance,
            'module_name' => $module,
            'previous_id' => $previous_id,
            'next_id' => $next_id,
        ]);
    }

    public function custom_form_handler(Request $request, $module, $id, $action)
    {
        $item = $this->modelInstance::findOrFail($id);
        $action_interface = $this->modelInstance->getCustomAction($action);
        return $action_interface->callHandler($item);
    }

    public function export(Request $request, $module, $type)
    {
        ini_set('max_execution_time', 6000);

        $instance = $this->modelInstance;
        $filter = $request->filter;
        $search_query = $request->q;
        $date_start = $request->date_start;
        $date_end = $request->date_end;

        $items = $instance->newQuery();

        if ($function = $instance->getListCondition()) {
            $items = $function($items);
        }

        if (is_array($filter)) {
            adminApplyQueryFilters($items, $filter);
        }

        if ($date_start && $date_end) {
            $items->where('created_at', '>=', $date_start.' 00:00:00')
                ->where('created_at', '<=', $date_end.' 23:59:59');
        }

        if ($search_query) {
            $items->where(function($query) use ($instance, $search_query) {
                foreach($instance->getSearchAttributes() as $key => $attribute) {
                    if ($key === 0) {
                        $query->where($attribute, 'like', '%'.$search_query.'%');
                    } else {
                        $query->orWhere($attribute, 'like', '%'.$search_query.'%');
                    }
                }
            });
        }

        if ($request->order && $request->dir) {
            $items->orderBy($request->order, $request->dir);
        } else {
            $items->orderBy($instance->getOrderAttribute(), $instance->getOrderDirection());
        }

        $items = $items->get();

        if ($type == 'xls') {
            $data = [];
            $data[0] = ['ID'];
            foreach($instance->getAdminColumns() as $column) {
                $data[0][] = $column->getTitle();
            }

            foreach($items as $item) {
                $row = [$item->id];
                foreach($instance->getAdminColumns() as $column) {
                    $row[] = remove_emoji(str_replace([chr(10), ';'], ['', ','], strip_tags($column->render($item))));
                }

                $data[] = $row;
            }

            $export = new ExcelExport($data);

            return Excel::download($export, 'LifestyleExpert_' . ucfirst($module) . '_' . date('Y-m-d_Hi') . '.xls');

        } elseif ($type == 'csv') {
            header ( "Content-Disposition: attachment; filename=LifestyleExpert_" . ucfirst($module) . "_" . date('Y-m-d_Hi') . ".csv" );

            foreach($items as $item) {
                echo $item->id . ';';
                foreach($instance->getAdminColumns() as $column) {
                    echo remove_emoji(str_replace([chr(10), ';'], ['', ','], strip_tags($column->render($item)))) . ';';
                }
                echo chr(10);
            }
        } elseif ($type == 'txt') {
            header ( "Content-Disposition: attachment; filename=LifestyleExpert_" . ucfirst($module) . "_" . date('Y-m-d_Hi') . ".txt" );

            foreach($items as $item) {
                foreach($instance->getAdminColumns() as $column) {
                    echo strip_tags($column->render($item)) . chr(9);
                }
                echo chr(10);
            }
        }


    }



}
