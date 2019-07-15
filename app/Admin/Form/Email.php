<?php

namespace App\Admin\Form;

class Email extends BaseControl
{
    public function render($state, $item) {
        return view('admin.modules.form.default.email', [
            'state' => $state,
            'item' => $item,
            'field' => $this
        ]);
    }

}