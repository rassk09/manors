<?php

namespace App\Models;

use App\Admin\Column\BaseColumn as Column;
use App\Admin\Form\BaseControl as Control;

class Region extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'position', 'geo_lat', 'geo_lng'
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
    public $moduleTitle = 'Области';

    /**
     * Admin module plural words
     *
     * @var array
     */
    public $modulePluralWords = [
        'область', 'области', 'областей', 'область'
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
            Column::text('position')->setTitle('Порядок')->sortable(),
        ]);
    }

    public function initializeAdminForm() {
        $this->setAdminFormControl([
            Control::text('name')->setTitle('Название')->required(),
            Control::text('position')->setTitle('Порядок')->required(),
            Control::text('geo_lat')->setTitle('Координаты - Широта')->required(),
            Control::text('geo_lng')->setTitle('Координаты - Долгота')->required(),
        ]);
    }

}
