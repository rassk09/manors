<?php

/**
 * Button For Single Backend Action
 * Works as Calling Custom Handler
 */

namespace App\Admin\Action;

class Button extends BaseAction
{
    /**
     * Button constructor.
     * @param $action
     * @param null $handler
     */
    public function __construct($action, $handler = null)
    {
        $this->isTab = true;
        $this->action = $action;

        if (is_object($handler)) {
            $this->handler = $handler;
        }
    }
}