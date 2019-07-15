<?php

namespace App\Models;

use App\Admin\Column\BaseColumn as Column;
use App\Admin\Form\BaseControl as Control;
use App\Admin\Filter\BaseFilter as Filter;

class Area extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'region_id', 'geo_lat', 'geo_lng'
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
    public $moduleTitle = 'Районы';

    /**
     * Admin module plural words
     *
     * @var array
     */
    public $modulePluralWords = [
        'район', 'района', 'районов', 'район'
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

    /***********************************
     * RELATIONS
     ***********************************/



    /***********************************
     * MODEL HELPERS FUNCTIONS
     ***********************************/

    /***********************************
     * ADMIN INITIALIZE FUNCTIONS
     ***********************************/

    /**
     * Initialize Admin List View
     */
    public function initializeAdminList() {
        $this->setAdminColumns([
            Column::text('name')->setTitle('Название')->sortable(),
//            Column::text('position')->setTitle('Порядок')->sortable(),
        ]);

        $this->setAdminFilters([
            Filter::select('region_id')->setTitle('Область')->setValues(Region::all()->pluck('name', 'id')),
        ]);
    }

    public function initializeAdminForm() {
        $this->setAdminFormControl([
            Control::text('name')->setTitle('Название')->required(),
            Control::select('region_id', Region::all()->pluck('name', 'id'))->setTitle('Область'),
            Control::text('geo_lat')->setTitle('Координаты - Широта')->required(),
            Control::text('geo_lng')->setTitle('Координаты - Долгота')->required(),
        ]);
    }

}
