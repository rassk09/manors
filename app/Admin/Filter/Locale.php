<?php

/**
 * Locales Filter
 */

namespace App\Admin\Filter;

use App\Models\Locale as LocaleModel;

class Locale extends BaseFilter
{
    /**
     * Locale constructor.
     * @param $attribute
     */
    public function __construct($attribute)
    {
        $this->attribute = $attribute;
        $this->title = 'Локали';
        $this->title_all = 'Все локали';

        $locales = LocaleModel::all();
        foreach ($locales as $locale) {
            $this->values[$locale->id] = $locale->getAdminFlagIcon() . $locale->getLocaleName();
        }
    }

    /**
     * View Render
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
        $locales = LocaleModel::whereIn('id', $values)->get();
        foreach ($locales as $locale) {
            $this->values[$locale->id] = $locale->getAdminFlagIcon() . $locale->getLocaleName();
        }

        return $this;
    }
}