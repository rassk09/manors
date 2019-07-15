<?php

namespace App\Admin\Form;

class Text extends BaseControl
{
    public function render($state, $item) {
        return view('admin.modules.form.default.text', [
            'state' => $state,
            'item' => $item,
            'field' => $this,
            'properties' => $this->getProperties($state)
        ]);
    }

    public function renderTranslations($item, $locale) {
        return view('admin.modules.form.translations.text', [
            'item' => $item,
            'field' => $this,
            'locale' => $locale,
        ]);
    }

    public function getProperties($state = 'edit') {
        $properties = [
            'class' => 'form-control'
        ];

        if ($this->isRequred($state)) {
            $properties = array_merge($properties, [
                'data-parsley-required' => 'true',
                'data-parsley-maxlength' => 190,
                'placeholder' => 'Введите значение...'
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