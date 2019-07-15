<?php

/**
 * Link Button to Custom Form
 */

namespace App\Admin\Action;

class LinkButton extends BaseAction
{
    /**
     * Request Arguments
     * @var array
     */
    public $parameters;

    /**
     * LinkButton constructor.
     * @param $action
     * @param array $parameters
     */
    public function __construct($action, $parameters = [])
    {
        $this->action = $action;
        $this->parameters = $parameters;
        $this->buttonType = 'link';
    }

    /**
     * Get Controller Action
     * @param $module
     * @param $id
     * @return string
     */
    public function getActionURL($module, $id)
    {
        $action_parameters = array_merge(['module' => $module, 'id' => $id], $this->parameters);
        return action($this->action, $action_parameters);
    }

}