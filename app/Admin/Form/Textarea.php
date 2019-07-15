<?php

namespace App\Admin\Form;

class Textarea extends BaseControl
{
    public function render($state, $item) {
        return view('admin.modules.form.default.textarea', [
            'state' => $state,
            'item' => $item,
            'field' => $this,
            'properties' => $this->getProperties($state)
        ]);
    }

    public function renderTranslations($item, $locale) {
        return view('admin.modules.form.translations.textarea', [
            'item' => $item,
            'field' => $this,
            'locale' => $locale,
        ]);
    }

    public function getProperties($state) {
        $properties = [
            'class' => 'form-control'
        ];

        if ($this->isRequred($state)) {
            $properties = array_merge($properties, [
                'data-parsley-required' => 'true',
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