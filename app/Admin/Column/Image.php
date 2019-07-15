<?php

/**
 * Image Column
 */

namespace App\Admin\Column;

class Image extends BaseColumn
{
    /**
     * Image constructor.
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
        $value = $item->$attribute;
        return '<img src="' . $value . '" width="50" />';
    }


}