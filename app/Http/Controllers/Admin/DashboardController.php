<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
//        if (!in_array($this->__auth->role, ['admin'])) {
            foreach(config('admin.sidebar') as $sidebar) {
                if (!isset($sidebar['role']) || in_array(\Auth::user()->role, $sidebar['role'])) {
                    if (isset($sidebar['route']) && $sidebar['route'] != 'admin_dashboard') {
                        return redirect()->route($sidebar['route'], $sidebar['route_attribute'] ?? []);
                    } elseif (isset($sidebar['items'])) {
                        return $this->innerRedirect($sidebar['items']);
                    }

                }
            }
//        }
//
//        return view('admin.pages.index');
    }

    public function innerRedirect($items)
    {
        foreach($items as $sidebar) {
            if (!isset($sidebar['role']) || in_array(\Auth::user()->role, $sidebar['role'])) {
                if (isset($sidebar['route'])) {
                    return redirect()->route($sidebar['route'], $sidebar['route_attribute'] ?? []);
                } elseif (isset($sidebar['items'])) {
                    return $this->innerRedirect($sidebar['items']);
                }
            }
        }
    }
}
