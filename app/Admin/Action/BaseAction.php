<?php

/**
 * Base Actions Class
 * Works as Custom Module Forms
 * Default view as Button in Module List View
 */

namespace App\Admin\Action;

use Mockery\Matcher\Closure;

abstract class BaseAction
{

    /***********************************************************************
     * Properties
     **********************************************************************/

    /**
     * Controller Action name
     * @var string
     */
    protected $action;

    /**
     * Custom Backend Handler
     * @var Closure
     */
    protected $handler = null;

    /**
     * Frontend CSS Class
     * @var string
     */
    protected $css_class;

    /**
     * Frontend Icon Class
     * @var string
     */
    protected $icon;

    /**
     * Frontend Tooltip text
     * @var string
     */
    protected $tooltip;

    /**
     * Frontend Success modal text
     * @var string
     */
    protected $successText;

    /**
     * Path to modal view file
     * @var string
     */
    protected $modalView;

    /**
     * Frontend Modal ID Name
     * @var string
     */
    protected $modalId;

    /**
     * Toggle Tooltip/Text
     * Default: true
     * @var bool
     */
    protected $isTooltip = true;

    /**
     * Toggle this Action as Form Tab
     * Default: false
     * @var bool
     */
    protected $isTab = false;

    /**
     * Toggle hidden
     * Default: false
     * @var bool
     */
    protected $isHidden = false;

    /**
     * Toggle Form Submit Button
     * Default: true
     * @var bool
     */
    protected $isSaveButton = true;

    /**
     * Frontend Handler Type
     * Values:
     *    (default) link - Link to Form page
     *              modal - Open modal form
     *              ajax - Async Request to Controller Action
     * @var string
     */
    protected $buttonType = 'link';

    /**
     * Toggle Frontend Remove Row Handler
     * Default: false
     * @var bool
     */
    protected $removeRow = false;

    /**
     * Frontend Selector for Frontend Remove Row Handler
     * @var string
     */
    protected $target = '';

    /***********************************************************************
     * Get Sub-Classes
     **********************************************************************/

    /**
     * Render Button
     * @param $action
     * @param $handler
     * @return Button
     */
    public static function button($action, $handler)
    {
        return new Button($action, $handler);
    }

    /**
     * Render Ajax Button
     * @param $action
     * @param $parameters
     * @return AjaxButton
     */
    public static function ajaxButton($action, $parameters)
    {
        return new AjaxButton($action, $parameters);
    }

    /**
     * Render Link
     * @param $action
     * @param $parameters
     * @return LinkButton
     */
    public static function linkButton($action, $parameters)
    {
        return new LinkButton($action, $parameters);
    }

    /***********************************************************************
     * Set/Get Methods
     **********************************************************************/

    /**
     * Set CSS Class
     * @param $css_class
     * @return $this
     */
    public function setCSSClass($css_class)
    {
        $this->css_class = $css_class;

        return $this;
    }

    /**
     * Set Frontend Icon Class
     * @param $icon
     * @return $this
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Set Tooltip text
     * @param $string
     * @return $this
     */
    public function setTooltip($string)
    {
        $this->tooltip = $string;

        return $this;
    }

    /**
     * Toggle Action as Form Tab
     * @return $this
     */
    public function setTab()
    {
        $this->isTab = true;

        return $this;
    }

    /**
     * Set Tooltip as Button Text
     * @return $this
     */
    public function setTooltipText()
    {
        $this->isTooltip = false;

        return $this;
    }

    /**
     * Set Success Modal Text
     * @param $text
     * @return $this
     */
    public function setSuccessText($text)
    {
        $this->successText = $text;

        return $this;
    }

    /**
     * Set Frontend ID Name
     * @param $target
     * @return $this
     */
    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Get Controller Action
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Get CSS Class
     * @return string
     */
    public function getCSSClass()
    {
        return $this->css_class;
    }

    /**
     * Get Frontend Icon Class
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Get Tooltip text
     * @return string
     */
    public function getTooltip()
    {
        return $this->tooltip;
    }

    /**
     * Get Controller Action
     * @param $module
     * @param $id
     * @return string
     */
    public function getActionURL($module, $id)
    {
        return action('Admin\AdminController@custom_form', ['module' => $module, 'id' => $id, 'action' => $this->action]);
    }

    /**
     * Get Button Type
     * @return string
     */
    public function getButtonType()
    {
        return $this->buttonType;
    }

    /**
     * Get Success Modal Text
     * @return string
     */
    public function getSuccessText()
    {
        return $this->successText;
    }

    /**
     * Get Modal View File
     * @return string
     */
    public function getModal()
    {
        return $this->modalView;
    }

    /**
     * Get Frontend ID Name
     * @return string
     */
    public function getTarget()
    {
        return $this->target;
    }

    /***********************************************************************
     * Boolean Methods
     **********************************************************************/

    /**
     * @return bool
     */
    public function isTab()
    {
        return $this->isTab;
    }

    /**
     * @return bool
     */
    public function isHidden()
    {
        return $this->isHidden;
    }

    /**
     * @return bool
     */
    public function isTooltip()
    {
        return $this->isTooltip;
    }

    /**
     * @return bool
     */
    public function isSaveButton()
    {
        return $this->isSaveButton;
    }

    /**
     * @return bool
     */
    public function isRemoveRow()
    {
        return $this->removeRow;
    }

    /***********************************************************************
     * Other Model Build Methods
     **********************************************************************/

    /**
     * Toggle Form Save Button
     * @return $this
     */
    public function hideSaveButton()
    {
        $this->isSaveButton = false;

        return $this;
    }

    /**
     * Hide this Action from Module List view
     * @return $this
     */
    public function hideListButton()
    {
        $this->isHidden = true;

        return $this;
    }

    /**
     * Activate Frontend Remove Row Handler
     * @return $this
     */
    public function removeRow()
    {
        $this->removeRow = true;

        return $this;
    }

    /**
     * Include Modal Form
     * @param $view
     * @param string $modal_id
     * @return $this
     */
    public function includeModal($view, $modal_id = '')
    {
        $this->modalView = $view;
        $this->modalId = $modal_id;
        $this->buttonType = 'modal';

        return $this;
    }

    /***********************************************************************
     * Other Methods
     **********************************************************************/

    /**
     * Call Custom Action Handler
     * @param $item
     * @return mixed
     */
    public function callHandler($item)
    {
        $handler = $this->handler;
        if (is_object($handler)) {
            return call_user_func($handler, $item);
        }
    }

    /**
     * Frontend Render Button
     *
     * @param $module_name
     * @param $item_id
     * @return string
     */
    public function buildHtml($module_name, $item_id)
    {
        $arr_attributes = [];
        $button_text = '';

        $arr_attributes['data-success-text'] = $this->getSuccessText();

        if ($this->isRemoveRow()) {
            $arr_attributes['data-success-remove'] = 'true';
        }

        if ($this->isTooltip()) {
            $arr_attributes['class'] = 'btn btn-' . $this->getCSSClass() . ' btn-icon btn-sm m-r-5 ' . ($this->getButtonType() == 'ajax' ? ' ajax_button ' : '');
            $arr_attributes['data-tooltip'] = 'tooltip';
            $arr_attributes['data-placement'] = 'top';
            $arr_attributes['data-title'] = $this->getTooltip();
        } else {
            $arr_attributes['class'] = 'btn btn-' . $this->getCSSClass() . ' btn-sm m-r-5 ' . ($this->getButtonType() == 'ajax' ? ' ajax_button ' : '');
            $button_text = $this->getTooltip();
        }

        if ($this->getButtonType() != 'modal') {
            $arr_attributes['href'] = $this->getActionURL($module_name, $item_id);
        } else {
            $arr_attributes['data-toggle'] = 'modal';
            $arr_attributes['data-action'] = $this->getActionURL($module_name, $item_id);
            $arr_attributes['href'] = $this->modalId;
        }

        if ($this->getTarget()) {
            $arr_attributes['target'] = $this->getTarget();
        }

        $attributes = join(' ', array_map(function ($key) use ($arr_attributes) {
            if (is_bool($arr_attributes[$key])) {
                return $arr_attributes[$key] ? $key : '';
            }

            return $key . '="' . $arr_attributes[$key] . '"';
        }, array_keys($arr_attributes)));

        return '<a ' . $attributes . '><i class="fa fa-' . $this->getIcon() . ' ' . (!$this->isTooltip() ? ' m-r-5' : '') . '"></i>' . $button_text . '</a>';

    }

}