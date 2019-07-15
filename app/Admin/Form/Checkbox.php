<?php

namespace App\Admin\Form;

class Checkbox extends BaseControl
{
    protected $connectedWith = [];

    public function render($state, $item) {
        return view('admin.modules.form.default.checkbox', [
            'state' => $state,
            'item' => $item,
            'field' => $this,
            'properties' => $this->getProperties($state),
        ]);
    }

    public function getProperties($state) {
        $properties = [
            'id' => $this->getAttribute()
        ];

        if ($this->isDisabled()) {
            $properties = array_merge($properties, [
                'disabled' => 'disabled',
            ]);
        }

        return $properties;
    }

    public function connectedWith(array $attributes)
    {
        $this->connectedWith = $attributes;

        return $this;
    }

    public function getConnectedWith()
    {
        return $this->connectedWith;
    }

}