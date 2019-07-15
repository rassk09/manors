<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Admin\Column\BaseColumn as Column;

abstract class BaseModel extends Model
{
    /**
     * Model attributes using for search in admin panel
     *
     * @var array
     */
    public $searchAttributes = [];

    /**
     * Admin module title
     *
     * @var string
     */
    public $moduleTitle;

    /**
     * Admin module plural words
     *
     * @var array
     */
    public $modulePluralWords;

    /**
     * Enable/disable create item
     *
     * @var bool
     */
    public $creatable = true;

    /**
     * Enable/disable edit item
     *
     * @var bool
     */
    public $editable = true;

    /**
     * Enable/disable delete item
     *
     * @var bool
     */
    public $deletable = true;

    /**
     * Enable/disable massive delete items
     *
     * @var bool
     */
    public $massDeletable = true;

    /**
     * Enable/disable search items
     *
     * @var bool
     */
    public $searchable = true;

    /**
     * Enable/disable massive export items
     *
     * @var bool
     */
    public $exportable = false;

    /**
     * Enable/disable translate item fields
     *
     * @var bool
     */
    public $translatable = false;

    /**
     * Enable/disable active status
     *
     * @var bool
     */
    public $toggleActive = true;

    /**
     * Enable/disable create item
     *
     * @var bool
     */
    public $moderationCreatable = false;

    /**
     * Enable/disable edit item
     *
     * @var bool
     */
    public $moderationEditable = true;

    /**
     * Enable/disable delete item
     *
     * @var bool
     */
    public $moderationDeletable = false;

    /**
     * Enable/disable massive delete items
     *
     * @var bool
     */
    public $moderationMassDeletable = false;

    /**
     * Array of columns list for Admin panel
     *
     * @var array
     */
    public $displayConfiguration;

    /**
     * Array of custom actions for Admin panel
     *
     * @var array
     */
    public $customActionConfiguration;

    /**
     * Array of filters list for Admin panel
     *
     * @var array
     */
    public $displayFilterConfiguration;

    /**
     * Create/Edit Form Configuration
     *
     * @var array
     */
    public $formConfiguration;

    /**
     * Ordering table by attribute for Admin panel
     *
     * @var string
     */
    public $defaultOrder = 'id';

    /**
     * Ordering direction for Admin panel
     *
     * @var string
     */
    public $defaultOrderDirection = 'desc';

    public $customMainForm;

    public $listCondition;

    /***********************************
     * ABSTRACT FUNCTIONS
     ***********************************/

    /**
     * Initialize list data and render type
     */
    abstract public function initializeAdminList();

    /**
     * Initialize form data and render type
     */
    abstract public function initializeAdminForm();

    /**
     * Initialize form data and render type
     */
    public function initializeAdminCustomActions() {}

    /**
     * Backend callback after Creating Action
     *
     * @param Request $request
     * @param BaseModel $item
     * @return mixed
     */
    public function callbackAfterCreate(Request $request, BaseModel $item) {}

    /**
     * Backend callback after Editing Action
     *
     * @param Request $request
     * @param BaseModel $item
     * @return mixed
     */
    public function callbackAfterEdit(Request $request, BaseModel $item) {}


    /***********************************
     * HELPERS FUNCTIONS
     ***********************************/

    /**
     * @return string
     */
    public function getNameOfClass()
    {
        $class = static::class;
        $path = explode('\\', $class);
        return array_pop($path);
    }

    /**
     * Returns model attributes using for search in admin panel
     *
     * @return array
     */
    public function getSearchAttributes()
    {
        return $this->searchAttributes;
    }

    /**
     * Get Module Title
     *
     * @return string
     */
    public function getModuleTitle()
    {
        return $this->moduleTitle;
    }

    /**
     * Get plural or singular word within data count
     *
     * @param $count
     * @return string
     */
    public function getModulePluralName($count)
    {
        $num = $count % 100;
        if ($num > 19) {
            $num = $count % 10;
        }
        switch ($num) {
            case -1: {
                return($this->modulePluralWords[3]);
            }
            case 1: {
                return($this->modulePluralWords[0]);
            }
            case 2: case 3: case 4: {
                return($this->modulePluralWords[1]);
            }
            default: {
                return($this->modulePluralWords[2]);
            }
        }
    }

    /**
     * Returns boolean flag for creating item in admin panel
     *
     * @return bool
     */
    public function isCreatable()
    {
        return $this->creatable && (\Auth::user()->role == 'admin' || $this->moderationCreatable);
    }

    /**
     * Returns boolean flag for editing item in admin panel
     *
     * @return bool
     */
    public function isEditable()
    {
        return $this->editable && (\Auth::user()->role == 'admin' || $this->moderationEditable);
    }

    /**
     * Returns boolean flag for deleting item in admin panel
     *
     * @return bool
     */
    public function isDeletable()
    {
        return $this->deletable && (\Auth::user()->role == 'admin' || $this->moderationDeletable);
    }

    /**
     * Returns boolean flag for massive deleting items in admin panel
     *
     * @return bool
     */
    public function isMassDeletable()
    {
        return $this->massDeletable && (\Auth::user()->role == 'admin' || $this->moderationMassDeletable);
    }

    /**
     * Returns boolean flag for massive deleting items in admin panel
     *
     * @return bool
     */
    public function isSearchable()
    {
        return $this->searchable;
    }

    /**
     * Returns boolean flag for export items in admin panel
     *
     * @return bool
     */
    public function isExportable()
    {
        return $this->exportable;
    }

    /**
     * Returns boolean flag for export items in admin panel
     *
     * @return bool
     */
    public function isTranslatable()
    {
        return $this->translatable;
    }

    /**
     * Returns boolean flag for active items in lists
     *
     * @return bool
     */
    public function isToggleActive()
    {
        return $this->toggleActive;
    }

    /**
     * Set columns list for Admin panel
     *
     * @param array $columns
     */
    public function setAdminColumns(array $columns)
    {
        $this->displayConfiguration = $columns;
    }

    /**
     * Get columns list for Admin panel
     *
     * @return array
     */
    public function getAdminColumns()
    {
        return $this->displayConfiguration;
    }

    /**
     * Get column interface for current attribute
     *
     * @param $attribute - Model attribute
     * @param $title - Column title
     * @param string $type - Column type
     * @param bool $sortable - Sortable
     * @return Column
     */
    public function getAdminAttributeColumn($attribute, $title, $type = 'text', $sortable = true) {
        return Column::$type($attribute)->setTitle($title)->sortable($sortable);
    }

    /**
     * Set filters list for Admin panel
     *
     * @param array $filters
     */
    public function setAdminFilters(array $filters)
    {
        $this->displayFilterConfiguration = $filters;
    }

    /**
     * Get filters list for Admin panel
     *
     * @return array
     */
    public function getAdminFilters()
    {
        return $this->displayFilterConfiguration ?? [];
    }

    /**
     * Set Create/Edit Form Configuration
     *
     * @param array $controls
     */
    public function setAdminFormControl(array $controls)
    {
        $this->formConfiguration = $controls;
    }

    /**
     * Get Create/Edit Form Configuration
     *
     * @return array
     */
    public function getAdminFormControl()
    {
        return $this->formConfiguration;
    }

    /**
     * Set Custom actions Configuration
     *
     * @param array $controls
     */
    public function setCustomActionConfiguration(array $configuration)
    {
        $this->customActionConfiguration = $configuration;
    }

    /**
     * Get Custom actions Configuration
     *
     * @return array
     */
    public function getCustomActionConfiguration()
    {
        return $this->customActionConfiguration ?? [];
    }

    public function getCustomAction($action) {
        $this->initializeAdminCustomActions();
        $model_actions = $this->getCustomActionConfiguration();

        foreach($model_actions as $model_action) {
            if ($model_action->getAction() == $action) {
                return $model_action;
            }
        }

        return null;
    }

    public function getCustomTabs() {
        $tabs = [];
        $actions = $this->getCustomActionConfiguration();
        foreach($actions as $action) {
            if ($action->isTab()) {
                $tabs[] = $action;
            }
        }

        return $tabs;
    }

    public function setCustomFormView($view) {
        $this->customMainForm = $view;
    }

    public function getCustomFormView() {
        return $this->customMainForm;
    }

    public function renderFormControl($attribute, $state, $item) {
        foreach($this->getAdminFormControl() as $control) {
            if ($control->getAttribute() == $attribute) {
                return $control->render($state, $item);
            }
        }
    }

    public function getOrderAttribute() {
        return $this->defaultOrder;
    }

    public function getOrderDirection() {
        return $this->defaultOrderDirection;
    }

    public function setListCondition(\Closure $function) {
        $this->listCondition = $function;
    }

    public function getListCondition() {
        return $this->listCondition;
    }

    public function getTranslationFields()
    {
        $arr_out = [];
        $this->initializeAdminForm();

        $controls = $this->getAdminFormControl();
        foreach($controls as $control) {
            if ($control->isTranslatable()) {
                $arr_out[] = $control;
            }
        }

        return $arr_out;
    }

    public function lang($attribute)
    {
        if ($attribute) {
            $code = '__content_' . strtolower($this->getNameOfClass()) . '_' . $this->id . '_' . $attribute;
            return Translation::$keys[$code] ?? (Translation::$masterKeys[$code] ?? $this->$attribute);
        }
    }

    public function getImage($type = '', $attr = 'image')
    {
        if (!isset($this->$attr) || !$this->$attr) {
            return '';
        }

        if (!$type) {
            return $this->$attr;
        }

        $cache = explode('/', $this->$attr);
        $count = count($cache);
        $cache[$count] = $cache[$count - 1];
        $cache[$count - 1] = $type;

        $new_path = join('/', $cache);

        if (file_exists(public_path($new_path))) {
            return $new_path;
        } else {
            return $this->$attr;
        }


    }

}