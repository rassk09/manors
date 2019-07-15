<?php

/**
 * Base Columns Class
 * Using for Module List views as Data Columns
 */

namespace App\Admin\Column;

abstract class BaseColumn
{

    /***********************************************************************
     * Properties
     **********************************************************************/

    /**
     * Column title
     * @var string
     */
    protected $title;

    /**
     * Model Ordering Attribute
     * Default: $attribute value
     * @var string
     */
    protected $orderBy;

    /**
     * Model Attribute
     * @var string
     */
    protected $attribute;

    /**
     * Toggle Frontend Ordering By Column
     * @var bool
     */
    protected $sortable = false;


    /***********************************************************************
     * Abstract Methods
     **********************************************************************/

    /**
     * View Render
     * @param $item
     */
    abstract public function render($item);

    /***********************************************************************
     * Get Sub-Classes
     **********************************************************************/

    /**
     * Render Custom Column View
     * @param $view
     * @return Custom
     */
    public static function custom($view)
    {
        return new Custom($view);
    }

    /**
     * Render Date Column View
     * @param $attribute
     * @return Date
     */
    public static function date($attribute)
    {
        return new Date($attribute);
    }

    /**
     * Render String Column View
     * TODO: Rename Text to String
     * @param $attribute
     * @return Text
     */
    public static function text($attribute)
    {
        return new Text($attribute);
    }

    /**
     * Render Image Column View
     * @param $attribute
     * @return Image
     */
    public static function image($attribute)
    {
        return new Image($attribute);
    }

    /***********************************************************************
     * Set/Get Methods
     **********************************************************************/

    /**
     * Set Column Title
     * @param $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get Column Title
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get Model Attribute
     * @return string
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * Get Model Ordering Attribute
     * @return string
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /***********************************************************************
     * Boolean Methods
     **********************************************************************/

    /**
     * @return bool
     */
    public function isSortable()
    {
        return $this->sortable;
    }

    /***********************************************************************
     * Other Model Build Methods
     **********************************************************************/

    /**
     * Activate Frontend Sortable
     * @param null|string $attribute
     * @return $this
     */
    public function sortable($attribute = null)
    {
        if ($attribute !== false) {
            $this->sortable = true;
            if ($attribute && !is_bool($attribute)) {
                $this->orderBy = $attribute;
            } else {
                $this->orderBy = $this->attribute;
            }
        }

        return $this;
    }

}