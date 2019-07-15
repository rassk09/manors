<?php

/**
 * Base Model Filters Class
 * Uses 'filter' Attribute in Request
 */

namespace App\Admin\Filter;

abstract class BaseFilter
{

    /***********************************************************************
     * Properties
     **********************************************************************/

    /**
     * Model Attribute
     * @var string
     */
    protected $attribute;

    /**
     * Frontend Render Type
     * @var string
     */
    protected $type = 'select';

    /**
     * Filter Title
     * @var string
     */
    protected $title;

    /**
     * Array of filtering values
     * @var array
     */
    protected $values;

    /**
     * All values title (Reset Filter name)
     * @var string
     */
    protected $title_all = 'Все значения';

    /***********************************************************************
     * Abstract Methods
     **********************************************************************/

    /**
     * View render
     * @return mixed
     */
    abstract public function render();

    /***********************************************************************
     * Get Sub-Classes
     **********************************************************************/

    /**
     * Render Select Filter
     * @param $attribute
     * @return Select
     */
    public static function select($attribute)
    {
        return new Select($attribute);
    }

    /**
     * Render Locales Filter
     * Uses Locale, User, UserLocale Models
     * @param $attribute
     * @return Locale
     */
    public static function locale($attribute)
    {
        return new Locale($attribute);
    }

    /**
     * Render Countries Filter
     * Uses Country Model
     * @param $attribute
     * @return Country
     */
    public static function country($attribute)
    {
        return new Country($attribute);
    }

    /**
     * Render Datetime Period Filter
     * @param $attribute
     * @return Period
     */
    public static function period($attribute)
    {
        return new Period($attribute);
    }

    /***********************************************************************
     * Set/Get Methods
     **********************************************************************/

    /**
     * Set Filter Title
     * @param $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Set Available Filtering values
     * @param array $values
     * @return $this
     */
    public function setValues($values = [])
    {
        $this->values = $values;

        return $this;
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
     * Get Filter Title
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get Reset Title
     * @return string
     */
    public function getTitleAll()
    {
        return $this->title_all;
    }

    /**
     * Get Filter type
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get all Available Filtering Values
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }

    /***********************************************************************
     * Boolean Methods
     **********************************************************************/

    /**
     * Returns true if filter is active for Request
     * @return bool
     */
    public function isActiveFilter()
    {
        $request = request();
        return isset($request->filter[$this->attribute]);
    }

    /***********************************************************************
     * Other Methods
     **********************************************************************/

    /**
     * Get active Filtering value
     * @return mixed
     */
    public function getActiveValue()
    {
        $request = request();
        return $request->filter[$this->attribute];
    }

    /**
     * Get active Filtering value name
     * @param string $value
     * @return mixed
     */
    public function getValueName($value = '')
    {
        if (!$value) {
            $value = $this->getActiveValue();
        }

        return $this->values[$value];
    }

    /**
     * Return Request without this Filter
     * @param array $except
     * @return array
     */
    public function getRequestWithoutThis($except = [])
    {
        $request = request()->all();
        if (isset($request['filter'])) {
            unset($request['filter'][$this->attribute]);
            if (count($request['filter']) == 0) {
                unset($request['filter']);
            }
        }

        foreach ($except as $value) {
            unset($request[$value]);
        }

        return $request;
    }

}