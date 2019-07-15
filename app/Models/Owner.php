<?php

namespace App\Models;

use App\Admin\Column\BaseColumn as Column;
use App\Admin\Form\BaseControl as Control;

class Owner extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'is_active'
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
    public $moduleTitle = 'Владельцы';

    /**
     * Admin module plural words
     *
     * @var array
     */
    public $modulePluralWords = [
        'владелец', 'владельца', 'владельцев', 'владельца'
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
            Column::custom('owners.is_active')->setTitle('Статус')->sortable('is_active'),
        ]);
    }

    public function initializeAdminForm() {
        $this->setAdminFormControl([
            Control::text('name')->translatable()->setTitle('Название')->required(),
            Control::checkbox('is_active')->setTitle('Активен'),
        ]);
    }

}
