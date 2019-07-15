<?php

/**
 * String View
 * TODO: Rename Text to String
 */
namespace App\Admin\Column;

class Text extends BaseColumn
{
    /**
     * Text constructor.
     * @param $attribute
     */
    public function __construct($attribute)
    {
        $this->attribute = $attribute;
    }

    /**
     * View Render
     * @param $item
     * @return mixed
     */
    public function render($item)
    {
        $attribute = $this->attribute;
        return $item->$attribute;
    }


}