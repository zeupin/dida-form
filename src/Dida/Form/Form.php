<?php
/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files MUST retain the above copyright notice.
 */

namespace Dida\Form;

class Form
{
    const VERSION = '20171116';

    const REQUEST_METHOD = 'DIDA_REQUEST_METHOD';

    protected $method = null;
    protected $formElement = null;


    use FormControlTrait;


    public function __construct($action = null, $method = 'get', $name = null, $id = null)
    {
        $this->formElement = new \Dida\Html\ActiveElement('form');

        $this->setMethod($method);
    }


    public function setMethod($method)
    {
        $method = strtolower($method);
        switch ($method) {
            case 'get':
            case 'post':
                $this->method = $method;
                $this->formElement->setProp('method', $method);
                unset($this->controls[self::REQUEST_METHOD]);
                break;

            case 'put':
            case 'patch':
            case 'delete':
            case 'head':
            case 'options':
                $this->method = $method;
                $this->formElement->setProp('method', 'post');
                $this->addHidden(null, self::REQUEST_METHOD, $method, null, self::REQUEST_METHOD);
                break;

            default:
                throw new FormException($method, FormException::INVALID_METHOD);
        }

        return $this;
    }


    public function getMethod()
    {
        return $this->method;
    }


    public function &refFormElement()
    {
        return $this->formElement;
    }


    public function build()
    {
        $output = [];
        foreach ($this->controls as $control) {
            $output[] = $control->build();
        }
        $html = implode('', $output);
        $this->formElement->setInnerHTML($html);

        return $this->formElement->build();
    }
}
