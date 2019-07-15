<?php

namespace App\Admin\Form;

class Wysiwyg extends BaseControl
{
    public function render($state, $item) {
        return view('admin.modules.form.default.wysiwyg', [
            'state' => $state,
            'item' => $item,
            'field' => $this,
            'properties' => $this->getProperties($state)
        ]);
    }

    public function renderTranslations($item, $locale) {
        return view('admin.modules.form.translations.wysiwyg', [
            'item' => $item,
            'field' => $this,
            'locale' => $locale,
        ]);
    }

    public function getProperties($state) {
        $properties = [
            'class' => 'form-control mce'
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