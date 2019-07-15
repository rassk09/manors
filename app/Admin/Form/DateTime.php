<?php

namespace App\Admin\Form;

class DateTime extends BaseControl
{
    public function render($state, $item) {
        return view('admin.modules.form.default.datetime', [
            'state' => $state,
            'item' => $item,
            'field' => $this,
            'properties' => $this->getProperties($state),
        ]);
    }

    public function getProperties($state = 'edit') {
        $properties = [
            'class' => 'form-control datetimepicker'
        ];

        if ($this->isRequred($state)) {
            $properties = array_merge($properties, [
                'data-parsley-required' => 'true',
                'placeholder' => 'Выберите дату...'
            ]);
        }

        if ($this->isDisabled()) {
            $properties = array_merge($properties, [
                'disabled' => 'disabled',
            ]);
        }

        return $properties;
    }

}