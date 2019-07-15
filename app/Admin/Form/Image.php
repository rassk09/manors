<?php

namespace App\Admin\Form;

class Image extends BaseControl
{
    protected $action;

    public function __construct($attribute, $action)
    {
        $this->action = $action;

        parent::__construct($attribute);
    }

    public function getAction()
    {
        return $this->action;
    }

    public function render($state, $item)
    {
        return view('admin.modules.form.default.image', [
            'state' => $state,
            'item' => $item,
            'field' => $this,
            'properties' => $this->getProperties($state),
        ]);
    }

    public function renderTranslations($item, $locale)
    {
        return view('admin.modules.form.translations.image', [
            'item' => $item,
            'field' => $this,
            'locale' => $locale,
        ]);
    }

    public function getProperties($state)
    {
        $properties = [
            'class' => 'form-control'
        ];

        if ($this->isRequred($state)) {
            $properties = array_merge($properties, [
                'data-parsley-required' => 'true',
                'data-parsley-maxlength' => 60,
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