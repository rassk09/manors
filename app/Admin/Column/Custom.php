<?php

/**
 * Custom Column View
 */

namespace App\Admin\Column;

class Custom extends BaseColumn
{
    /**
     * Custom View Filename
     * @var string
     */
    protected $view;

    /**
     * Custom constructor.
     * @param $view
     */
    public function __construct($view)
    {
        $this->view = $view;
    }

    /**
     * View Render
     * @param $item
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render($item)
    {
        return view('admin.modules.list.' . $this->view, [
            'item' => $item
        ]);
    }


}