<?php

/**
 * Date Column
 */

namespace App\Admin\Column;

class Date extends BaseColumn
{
    /**
     * Date constructor.
     * @param $attribute
     */
    public function __construct($attribute)
    {
        $this->attribute = $attribute;
    }

    /**
     * View Render
     * @param $item
     * @return string
     */
    public function render($item)
    {
        $attribute = $this->attribute;
        return $item->$attribute ? $item->$attribute->format(config('admin.default_date_format')) : '';
    }


}