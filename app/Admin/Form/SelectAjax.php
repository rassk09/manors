<?php

namespace App\Admin\Form;

class SelectAjax extends BaseControl
{
    protected $action;

    public function __construct($attribute, $action)
    {
        $this->action = $action;

        parent::__construct($attribute);
    }

    public function getAction() {
        return $this->action;
    }

    public function render($state, $item) {
        return view('admin.modules.form.default.select_ajax', [
            'state' => $state,
            'item' => $item,
            'field' => $this
        ]);
    }

}