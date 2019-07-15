<?php

/**
 * Datetime Period Filter
 */

namespace App\Admin\Filter;

class Period extends BaseFilter
{
    /**
     * Period constructor.
     * @param $attribute
     */
    public function __construct($attribute) {
        $this->attribute = $attribute;
        $this->title = 'Фильтр по датам';
    }

    /**
     * View Render
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function render() {
        $request = request();
        return view('admin.modules.list.default.filter_period', ['filter' => $this, 'request' => $request]);
    }
}