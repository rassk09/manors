<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Manor;
use App\Models\PrivacyType;
use App\Models\Region;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return $this->view('welcome');
    }

    public function map(Request $request)
    {
        $manors = Manor::where('is_active', '=', 1)
            ->orderBy('name', 'asc')
            ->get();

        $regions = Region::orderBy('name', 'asc')
            ->get();

        $privacy_types = PrivacyType::where('is_active', '=', '1')
            ->orderBy('id', 'asc')
            ->get();

        $areas = Area::all();

        return $this->view('map', [
            'manors' => $manors,
            'regions' => $regions,
            'areas' => $areas,
            'privacy_types' => $privacy_types,
        ]);
    }

    public function favorites(Request $request)
    {
        $manors = Manor::whereIn('id', explode(',', session('favorite')))
            ->where('is_active', '=', 1)
            ->orderBy('name', 'asc')
            ->get();

        $regions = Region::orderBy('name', 'asc')
            ->get();

        $privacy_types = PrivacyType::where('is_active', '=', '1')
            ->orderBy('id', 'asc')
            ->get();

        $areas = Area::all();

        return $this->view('map', [
            'manors' => $manors,
            'regions' => $regions,
            'areas' => $areas,
            'privacy_types' => $privacy_types,
        ]);
    }

    public function manor(Request $request, $id)
    {
        $manor = Manor::findOrFail($id);

        return $this->view('manor', [
            'manor' => $manor,
        ]);
    }

}
