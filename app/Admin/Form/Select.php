<?php

namespace App\Admin\Form;

class Select extends BaseControl
{
    protected $values;
    protected $connectedWith = false;
    protected $connectedForeignKey = false;
    protected $showKey = 'id';
    protected $showAttribute = false;
    protected $hasSearch = 'false';

    public function __construct($attribute, $values)
    {
        $this->values = $values;

        parent::__construct($attribute);
    }

    public function getSelectValues()
    {
        if ($this->showAttribute) {
            $out_values = [];
            $key = $this->showKey;
            $attribute = $this->showAttribute;

            foreach($this->values as $value) {
                $out_values[$value->$key] = $value->$attribute;
            }

            return $out_values;

        } else {
            return $this->values;
        }
    }

    public function getOptionsAttributes()
    {
        if ($this->connectedWith) {
            $option_attributes = [];
            $key = $this->showKey;
            $attribute = $this->connectedWith;
            $foreign_key = $this->connectedForeignKey;

            foreach($this->values as $value) {
                $option_attributes[$value->$key] = [
                    'data-' . str_replace('_', '-', $foreign_key) => $value->$attribute,
                ];
            }

            return $option_attributes;
        } else {
            return [];
        }
    }

    public function pluck($attribute, $key)
    {
        $this->showKey = $key;
        $this->showAttribute = $attribute;

        return $this;
    }

    public function connectedWith($attribute, $foreign_key = '')
    {
        $this->connectedWith = $attribute;
        $this->connectedForeignKey = $foreign_key ? $foreign_key : $attribute;

        return $this;
    }

    public function getConnectedWith()
    {
        return $this->connectedWith;
    }

    public function getConnectedForeignKey()
    {
        return $this->connectedForeignKey;
    }

    public function setSearch()
    {
        $this->hasSearch = 'true';

        return $this;
    }

    public function hasSearch()
    {
        return $this->hasSearch;
    }

    public function render($state, $item) {
        return view('admin.modules.form.default.select', [
            'state' => $state,
            'item' => $item,
            'field' => $this
        ]);
    }

}