<?php

namespace App\Http\Controllers;

use App\Models\Manor;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function addToFavorite(Request $request, $id)
    {
        $manor = Manor::findOrFail($id);
        $favorites = explode(',', session('favorite') ?? null);
        $favorites[] = $manor->id;
        $request->session()->put('favorite', join(',', array_unique($favorites)));

        return $this->successResponse(explode(',', session('favorite')));
    }

    public function removeFromFavorite(Request $request, $id)
    {
        $manor = Manor::findOrFail($id);
        $favorites = explode(',', session('favorite') ?? null);
        $key = array_search($manor->id, $favorites);
        if ($key || $key === 0) {
            unset($favorites[$key]);
            $request->session()->put('favorite', join(',', array_unique($favorites)));
        }

        return $this->successResponse(explode(',', session('favorite')));
    }

    protected function successResponse(array $data = [])
    {
        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200);
    }
}
