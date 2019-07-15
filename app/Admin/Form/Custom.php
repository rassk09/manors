<?php

namespace App\Admin\Form;

class Custom extends BaseControl
{
    /**
     * @var array
     */
    protected $customData;

    public function setCustomData(array $data)
    {
        $this->customData = $data;

        return $this;
    }


    public function render($state, $item) {
        return view('admin.modules.form.' . $this->attribute, array_merge([
            'state' => $state,
            'item' => $item,
            'field' => $this
        ], $this->customData));
    }

}