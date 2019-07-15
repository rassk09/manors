<?php

namespace App\Models;

use App\Admin\Column\BaseColumn as Column;
use App\Admin\Form\BaseControl as Control;
use App\Admin\Filter\BaseFilter as Filter;
use App\Admin\Action\BaseAction as Action;
use App\Admin\UploadHandler;

class Manor extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type_id', 'privacy_type_id', 'owner_id', 'name', 'image', 'region_id', 'area_id', 'address', 'geo_lat', 'geo_lng', 'number', 'is_active'
    ];

    /**
     * The attributes that using as dates
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * Admin module title
     *
     * @var string
     */
    public $moduleTitle = 'Усадьбы';

    /**
     * Admin module plural words
     *
     * @var array
     */
    public $modulePluralWords = [
        'усадьба', 'усадьбы', 'усадеб', 'усадьбу'
    ];

    /**
     * Model attributes using for search in admin panel
     *
     * @var array
     */
    public $searchAttributes = [
        'name'
    ];

    /**
     * Enable/disable active status
     *
     * @var bool
     */
    public $toggleActive = false;

    /**
     * Base upload path
     *
     * @var string
     */
    public $baseImagesPath = '/uploads/manors/';

    /***********************************
     * RELATIONS
     ***********************************/

    /**
     * Relation Manor to Photos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos() {
        return $this->hasMany(ManorPhoto::class, 'manor_id')->orderBy('id', 'asc');
    }

    public function texts() {
        return $this->hasMany(ManorText::class, 'manor_id')->orderBy('id', 'asc');
    }

    public function privacy_type()
    {
        return $this->belongsTo(PrivacyType::class, 'privacy_type_id');
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }



    /***********************************
     * MODEL HELPERS FUNCTIONS
     ***********************************/

    /**
     * Get upload path for Event format
     *
     * @return string
     */
    public function getUploadPath() {
        return str_replace('//', '/', $this->baseImagesPath . '/' . $this->id . '/');
    }

    public function getType()
    {
        return $this->type_id == 1 ? 'Возрожденная' : 'Заброшенная';
    }

    /***********************************
     * ADMIN INITIALIZE FUNCTIONS
     ***********************************/

    /**
     * Initialize Admin List View
     */
    public function initializeAdminList() {
        $this->setAdminColumns([
            Column::text('name')->setTitle('Название')->sortable(),
            Column::custom('manors.type')->setTitle('Состояние')->sortable('type_id'),
        ]);

        $this->setAdminFilters([
            Filter::period('created_at'),
            Filter::select('type_id')->setTitle('Состояние')->setValues([0 => 'Заброшенные', 1 => 'Возрожденные']),
            Filter::select('privacy_type_id')->setTitle('Вид собственности')->setValues(PrivacyType::all()->pluck('name', 'id')),
            Filter::select('region_id')->setTitle('Область')->setValues(Region::all()->pluck('name', 'id')),
        ]);
    }

    public function initializeAdminForm() {
        $this->setAdminFormControl([
            Control::text('name')->translatable()->setTitle('Название')->required(),
            Control::text('number')->translatable()->setTitle('Реестровый номер'),
            Control::select('type_id', [0 => 'Заброшенные', 1 => 'Возрожденные'])->setTitle('Состояние усадьбы'),
            Control::select('privacy_type_id', PrivacyType::all()->pluck('name', 'id'))->setTitle('Вид собственности'),
            Control::select('owner_id', array_merge([0 => 'Нет владельца'], Owner::all()->pluck('name', 'id')->toArray()))->setTitle('Владелец'),
            Control::image('image', 'Admin\ApiController@uploadManorImage')->setTitle('Главное изображение')->required(),
            Control::select('region_id', Region::orderBy('position')->get()->pluck('name', 'id'))->setTitle('Область')->required(),
            Control::select('area_id', Area::all())->pluck('name', 'id')->setSearch()->connectedWith('country_id')->setTitle('Район'),
            Control::text('address')->setTitle('Адрес')->required(),
            Control::text('geo_lat')->setTitle('Координаты - Широта')->required(),
            Control::text('geo_lng')->setTitle('Координаты - Долгота')->required(),
            Control::checkbox('is_active')->setTitle('Показывать на сайте'),
        ]);
    }

    public function initializeAdminCustomActions() {
        $this->setCustomActionConfiguration([
            Action::button('images', function($item) {
                $upload_path = $item->getUploadPath();
                $upload_handler = new UploadHandler([
                    'upload_dir' => public_path($upload_path),
                    'upload_url' => $upload_path,
                ]);

                $response = $upload_handler->get_response();
                if ($file = $response['files'][0]) {
                    $image = ManorPhoto::create([
                        'manor_id' => $item->id,
                        'image' => $file->url,
                    ]);

                    return response()->json(['files' => [$image->jsonResponse()]], 200);
                }
            })->setCSSClass('info')
                ->setIcon('file-image')
                ->setTooltip('Фотографии')
                ->setTooltipText()
                ->hideSaveButton()
                ->hideListButton(),

            Action::button('texts', function($item){})
                ->setCSSClass('info')
                ->setIcon('list')
                ->setTooltip('Тексты')
                ->hideSaveButton()
                ->hideListButton(),
        ]);
    }

}
