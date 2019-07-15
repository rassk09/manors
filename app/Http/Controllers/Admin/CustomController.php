<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Models\Test;
use App\Models\TestLocale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomController extends Controller
{
    public function testPages(Request $request)
    {
        $current_locale = $request->locale_id ?? 0;
        $current_category = $request->category_id ?? 0;

        $categories = \App\Models\TestCategory::all();
        $locales = \Auth::user()->getAvailableLocales();

        $tests_pages = \App\Models\TestPage::where('locale_id', '=', $current_locale)
            ->where('test_category_id', '=', $current_category)
            ->get();

        $tests_absent = Test::whereNotIn('id', $tests_pages->pluck('test_id'))
            ->where('is_active', '=', 1);

        if ($current_category) {
            $tests_absent->where('test_category_id', '=', $current_category);
        }

        if ($current_locale) {
            $tests_absent->whereIn('id', TestLocale::where('locale_id', '=', $current_locale)->get()->pluck('test_id'));
        }

        $tests_absent = $tests_absent->get();

        return view('admin.pages.tests_pages', [
            'tests_pages' => $tests_pages,
            'tests_absent' => $tests_absent,
            'categories' => $categories,
            'locales' => $locales,
        ]);
    }

    public function homePositions(Request $request)
    {
        $slides = \App\Models\Position::where('block_id', '=', 3)
            ->orderBy('x', 'asc')
            ->get();

        return view('admin.pages.positions.index', [
            'slides' => $slides,
        ]);
    }

    public function settings(Request $request)
    {
        $settings = Setting::orderBy('id', 'asc')
            ->get();

        return view('admin.pages.settings', [
            'settings' => $settings,
        ]);

    }

    public function settingsStore(Request $request)
    {
        $settings = Setting::all();

        foreach($settings as $setting) {
            if ($request->get($setting->alias) && $setting->content != $request->get($setting->alias)) {
                $setting->content = $request->get($setting->alias);
                $setting->save();
            }
        }

        return back()->with('message', 'Запись успешно обновлена');

    }


}
