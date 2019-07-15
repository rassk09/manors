<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Mobile_Detect;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Is mobile version
     *
     * @var bool
     */
    protected $__isMobile;

    protected $__route;

    protected $__auth;

    /**
     * Controller constructor.
     *
     * @param Request $request
     * @param Route $route
     */
    public function __construct(Request $request, Route $route)
    {
        $this->__route = $route;

        $mobile_detect = new Mobile_Detect();
        $this->__isMobile = $mobile_detect->isMobile();

        $this->__auth = Auth::user();
    }

    /**
     * Get mobile/desktop view
     *
     * @param $view
     * @param array $data
     * @return View
     */
    public function view($view, $data = [], $default = false) {
        $view = $default ? 'public.default.' . $view : ($this->__isMobile ? 'public.mobile.' . $view : 'public.desktop.' . $view);

        $data = array_merge($data, [
            '__auth' => $this->__auth,
            '__route' => $this->__route,
            '__action_name' => $this->__route->getActionName(),
            '__route_url' => request()->url(),
            '__route_path' => request()->path(),
            '__action_method' => $this->__route->getActionMethod(),
            '__isMobile' => $this->__isMobile,
        ]);

        return view($view, $data);
    }
}
