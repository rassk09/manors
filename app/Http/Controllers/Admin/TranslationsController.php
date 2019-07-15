<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Translation;

class TranslationsController extends AdminController
{
    public function index(Request $request, $module = 'translations')
    {
        /**
         * Get Data From DB
         */
        $instance = $this->modelInstance;
        $search_query = $request->q;

        $items = $instance->newQuery();
        $items->where('code', 'NOT LIKE', '__content_%');
        $items->groupBy('code');

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

        return view('admin.pages.translations.index', [
            'data' => $data,
            'request' => $request->all(),
            'instance' => $instance,
            'search_query' => $search_query,
            'module_name' => $module,
        ]);
    }

    public function createCode(Request $request)
    {
        $master_locale = $this->getMasterLocale();
        $locales = $this->getOtherLocales();

        return view('admin.pages.translations.form', [
            'request' => $request->all(),
            'instance' => $this->modelInstance,
            'master_locale' => $master_locale,
            'locales' => $locales,
        ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function editCode(Request $request, $code)
    {
        $item = Translation::where('code', '=', $code)
            ->orderBy('id', 'asc')
            ->firstOrFail();

        $master_locale = $this->getMasterLocale();
        $locales = $this->getOtherLocales();

        // get previous user id
        $previous_id = Translation::where('code', '<', $item->code)
            ->where('code', 'NOT LIKE', '__content_%')
            ->groupBy('code')
            ->max('code');

        // get next user id
        $next_id = Translation::where('code', '>', $item->code)
            ->where('code', 'NOT LIKE', '__content_%')
            ->groupBy('code')
            ->min('code');

        return view('admin.pages.translations.form', [
            'item' => $item,
            'code' => $code,
            'request' => $request->all(),
            'instance' => $this->modelInstance,
            'master_locale' => $master_locale,
            'locales' => $locales,
            'previous_id' => $previous_id,
            'next_id' => $next_id,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeCode(Request $request)
    {
        $code = $request->get('code');

        $master_locale = $this->getMasterLocale();
        $locales = $this->getOtherLocales();

        Translation::create([
            'code' => $code,
            'locale_id' => $master_locale->id,
            'content' => $request->master_content
        ]);

        foreach ($locales as $locale) {
            $content = $request->get('locale_content_' . $locale->id);
            if ($content && $content !== '') {
                Translation::create([
                    'code' => $code,
                    'locale_id' => $locale->id,
                    'content' => $content
                ]);
            }
        }

        return redirect()->action('Admin\TranslationsController@index')->with('message', 'Новый ключ для перевода создан');
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCode(Request $request, $code)
    {
        $item = Translation::where('code', '=', $code)
            ->orderBy('id', 'asc')
            ->firstOrFail();

        $arr_locales = \Auth::user()
            ->getAvailableLocalesRelation()
            ->get()
            ->pluck('id')
            ->toArray();

        Translation::where('code', '=', $code)
            ->whereIn('locale_id', $arr_locales)
            ->delete();

        $master_locale = $this->getMasterLocale();
        $locales = $this->getOtherLocales();

        if (\Auth::user()->role == 'admin') {
            Translation::create([
                'code' => $code,
                'locale_id' => $master_locale->id,
                'content' => $request->master_content
            ]);
        }

        foreach ($locales as $locale) {
            $content = $request->get('locale_content_' . $locale->id);
            if ($content && $content !== '')
            {
                Translation::create([
                    'code' => $code,
                    'locale_id' => $locale->id,
                    'content' => $content
                ]);
            }
        }

        return back()->with('message', 'Данные о ключе для перевода изменены');

    }

    public function editModule(Request $request, $model_name, $code, $model_id)
    {
        $locale = \App\Models\Locale::where('code', '=', $code)->firstOrFail();

        $object = "\\App\\Models\\$model_name";
        $item = $object::findOrFail($model_id);

        if ($item->isTranslatable()) {
            return view('admin.pages.translations.model', [
                'model_name' => $model_name,
                'model_id' => $model_id,
                'locale' => $locale,
                'item' => $item,
            ]);
        } else {
            abort(404);
        }
    }

    public function updateModule(Request $request, $model_name, $code, $model_id)
    {
        $arr_codes = [];
        $locale = \App\Models\Locale::where('code', '=', $code)->firstOrFail();

        $object = "\\App\\Models\\$model_name";
        $item = $object::findOrFail($model_id);

        foreach($request->all() as $key => $value) {
            if (strpos($key, '__content_') === 0) {
                $arr_codes[] = $key;
            }
        }

        Translation::where('locale_id', '=', $locale->id)
            ->whereIn('code', $arr_codes)
            ->delete();

        foreach ($arr_codes as $code) {
            $content = $request->get($code);
            if ($content && $content !== '') {
                Translation::create([
                    'code' => $code,
                    'locale_id' => $locale->id,
                    'content' => $content,
                ]);
            }
        }

        return back()->with('message', 'Перевод сохранен');
    }

    public function editTestQuestions(Request $request, $code, $test_id)
    {
        $locale = \App\Models\Locale::where('code', '=', $code)->firstOrFail();
        $item = \App\Models\Test::findOrFail($test_id);

        return view('admin.pages.translations.tests_questions', [
            'model_name' => 'Test',
            'model_id' => $test_id,
            'locale' => $locale,
            'item' => $item,
        ]);
    }




    public function getMasterLocale()
    {
        $locale = \App\Models\Locale::where('is_master', '=', 1)->first();

        return $locale;
    }

    public function getOtherLocales()
    {
        $locales = \Auth::user()
            ->getAvailableLocalesRelation()
            ->where('is_master', '=', 0)
            ->get();

        return $locales;
    }


}
