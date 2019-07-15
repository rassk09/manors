<?php

/**
 * Country Filter
 */

namespace App\Admin\Filter;

use App\Models\Country as CountryModel;

class Country extends BaseFilter
{
    /**
     * Country constructor.
     * @param $attribute
     */
    public function __construct($attribute)
    {
        $this->attribute = $attribute;
        $this->title = 'Страна';
        $this->title_all = 'Все страны';

        $countries = CountryModel::all();
        foreach ($countries as $country) {
            $this->values[$country->id] = $country->getAdminFlagIcon() . $country->name;
        }
    }

    /**
     * View render
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function render()
    {
        return view('admin.modules.list.default.filter_select', [
            'filter' => $this,
            'request' => request()
        ]);
    }

    /**
     * Set Available Filtering values
     * @param array $values
     * @return $this|BaseFilter
     */
    public function setValues($values = [])
    {
        $this->values = [];
        $countries = CountryModel::whereIn('id', $values)->get();
        foreach ($countries as $country) {
            $this->values[$country->id] = $country->getAdminFlagIcon() . $country->name;
        }

        return $this;
    }
}