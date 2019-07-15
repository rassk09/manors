<?php

namespace App\Admin\Form;

class Password extends BaseControl
{
    public function render($state, $item) {
        return view('admin.modules.form.default.password', [
            'state' => $state,
            'item' => $item,
            'field' => $this
        ]);
    }

}