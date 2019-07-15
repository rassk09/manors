<?php

namespace App\Admin\Form;

class Date extends BaseControl
{
    public function render($state, $item) {
        return view('admin.modules.form.default.date', [
            'state' => $state,
            'item' => $item,
            'field' => $this
        ]);
    }

}