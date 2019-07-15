<?php

/**
 * Base Form Control Class
 */

namespace App\Admin\Form;

abstract class BaseControl
{

    /***********************************************************************
     * Properties
     **********************************************************************/

    /**
     * Control Title
     * @var string
     */
    protected $title;

    /**
     * Control Title while editing record
     * Default: $this->title value
     * @var string
     */
    protected $editTitle;

    /**
     * Model Attribute
     * @var string
     */
    protected $attribute;

    /**
     * Toggle requirement while creating record
     * @var bool
     */
    protected $createRequire = false;

    /**
     * Toggle requirement while editing record
     * @var bool
     */
    protected $editRequire = false;

    /**
     * Toggle disabled attribute
     * @var bool
     */
    protected $disable = false;

    /**
     * Toggle translations
     * Uses Translation Model
     * @var bool
     */
    protected $translate = false;

    /**
     * BaseControl constructor.
     * @param $attribute
     */
    public function __construct($attribute)
    {
        $this->attribute = $attribute;
    }

    /***********************************************************************
     * Abstract Methods
     **********************************************************************/

    abstract public function render($state, $item);

    /***********************************************************************
     * Get Sub-Classes
     **********************************************************************/

    public static function custom($attribute)
    {
        return new Custom($attribute);
    }

    public static function date($attribute)
    {
        return new Date($attribute);
    }

    public static function dateTime($attribute)
    {
        return new DateTime($attribute);
    }

    public static function email($attribute)
    {
        return new Email($attribute);
    }

    public static function password($attribute)
    {
        return new Password($attribute);
    }

    public static function select($attribute, $values)
    {
        return new Select($attribute, $values);
    }

    public static function selectAjax($attribute, $action)
    {
        return new SelectAjax($attribute, $action);
    }

    public static function text($attribute)
    {
        return new Text($attribute);
    }

    public static function textarea($attribute)
    {
        return new Textarea($attribute);
    }

    public static function wysiwyg($attribute)
    {
        return new Wysiwyg($attribute);
    }

    public static function checkbox($attribute)
    {
        return new Checkbox($attribute);
    }

    public static function image($attribute, $action)
    {
        return new Image($attribute, $action);
    }










    public function renderSetting($setting)
    {
        $alias = $setting->alias;
        $setting->$alias = $setting->content;

        return $this->render('edit', $setting);
    }

    public function setTitle($title, $editTitle = '')
    {
        $this->title = $title;
        $this->editTitle = $editTitle;

        return $this;
    }

    public function getTitle(string $state = 'edit')
    {
        return ($state == 'edit' && $this->editTitle) ? $this->editTitle : $this->title;
    }

    public function getAttribute()
    {
        return $this->attribute;
    }

    public function getTranslationAttribute($item)
    {
        return '__content_' . strtolower($item->getNameOfClass()) . '_' . $item->id . '_' . $this->getAttribute();
    }

    public function getValue($item)
    {
        if ($item ?? null) {
            $attribute = $this->attribute;
            return $item->$attribute;
        }
    }

    public function required()
    {
        $this->createRequire = true;
        $this->editRequire = true;

        return $this;
    }

    public function disabled()
    {
        $this->disable = true;

        return $this;
    }

    public function translatable()
    {
        $this->translate = true;

        return $this;
    }

    public function createRequired()
    {
        $this->createRequire = true;

        return $this;
    }

    public function editRequired()
    {
        $this->editRequire = true;

        return $this;
    }

    public function isRequred($state)
    {
        return ($state == 'edit') ? $this->editRequire : $this->createRequire;
    }

    public function isDisabled()
    {
        return $this->disable;
    }

    public function isTranslatable()
    {
        return $this->translate;
    }

}