<?php

/**
 * Simple Select Filter
 */

namespace App\Admin\Filter;

class Select extends BaseFilter
{
    /**
     * Select constructor.
     * @param $attribute
     */
    public function __construct($attribute) {
        $this->attribute = $attribute;
    }

    /**
     * View Render
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function render() {
        $request = request();
        return view('admin.modules.list.default.filter_select', ['filter' => $this, 'request' => $request]);
    }
}