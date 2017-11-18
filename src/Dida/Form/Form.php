<?php
/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files MUST retain the above copyright notice.
 */

namespace Dida\Form;

use \Dida\Form\Exceptions\FormException;

class Form
{
    const VERSION = '20171116';

    const REQUEST_METHOD = 'DIDA_REQUEST_METHOD';

    protected $method = null;

    protected $controls = [];

    protected $control_types = [
        'hidden'     => 'Dida\\Form\\Hidden',
        'text'       => 'Dida\\Form\\Text',
        'password'   => 'Dida\\Form\\Password',
        'statictext' => 'Dida\\Form\\StaticText',
        'button'     => 'Dida\\Form\\Button',
        'reset'      => 'Dida\\Form\\Reset',
        'submit'     => 'Dida\\Form\\Submit',
        'textarea'   => 'Dida\\Form\\TextArea',
        'radiogroup' => 'Dida\\Form\\RadioGroup',
        'select'     => 'Dida\\Form\\Select',
    ];

    protected $props = null;


    public function __construct($action = null, $method = 'get', $name = null, $id = null)
    {
        $this->props = new PropertySet([
            'id'     => $id,
            'name'   => $name,
            'method' => 'get',
            'action' => $action,
        ]);

        $this->setMethod($method);
    }


    public function build()
    {
        $output = [];

        $output[] = '<form';

        $output[] = $this->props->build();

        $output[] = '>';

        foreach ($this->controls as $control) {
            $output[] = $control->build();
        }

        $output[] = '</form>';

        return implode('', $output);
    }


    public function setMethod($method)
    {
        $method = strtolower($method);
        switch ($method) {
            case 'get':
            case 'post':
                $this->method = $method;
                $this->props->set('method', $method);
                unset($this->controls[self::REQUEST_METHOD]);
                break;

            case 'put':
            case 'patch':
            case 'delete':
            case 'head':
            case 'options':
                $this->method = $method;
                $this->props->set('method', 'post');
                $this->add('hidden', self::REQUEST_METHOD, $method, null, self::REQUEST_METHOD);
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


    public function setProp($name, $value)
    {
        $this->props->set($name, $value);
        return $this;
    }


    public function getProp($name)
    {
        return $this->props->get($name);
    }


    public function registerType($type, $class)
    {
        $type = strtolower($type);
        $this->control_types[$type] = $class;

        return $this;
    }


    public function &add($type, $name = null, $value = null, $id = null, $index = null)
    {
        $type = strtolower($type);
        if (!array_key_exists($type, $this->control_types)) {
            throw new FormException($type, FormException::TYPE_NOT_FOUND);
        }

        $control = new $this->control_types[$type]($name, $id);

        $control->value($value);

        $control->setForm($this);

        if (is_string($index)) {
            $this->controls[$index] = &$control;
        } else {
            $this->controls[] = &$control;
        }

        return $control;
    }
}
