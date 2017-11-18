<?php
/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files MUST retain the above copyright notice.
 */

namespace Dida\Form;

abstract class FormControl
{
    const VERSION = '20171118';

    protected $form = null;

    protected $props = null;

    protected $label = null;

    protected $value = null;

    protected $valueHtml = null;


    abstract public function build();


    public function __construct($name = null, $id = null)
    {
        $this->props = new PropertySet([
            'id'   => $id,
            'name' => $name,
        ]);
    }


    public function setForm(&$form)
    {
        $this->form = $form;

        return $this;
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


    public function addClass($class)
    {
        $this->props->addClass($class);
        return $this;
    }


    public function removeClass($class)
    {
        $this->props->removeClass($class);
        return $this;
    }


    public function addStyle($style)
    {
        $this->props->addStyle($style);
        return $this;
    }


    public function value($value)
    {
        if (is_null($value)) {
            $this->value = null;
            $this->valueHtml = null;
            return $this;
        }

        if (!is_string($value)) {
            $value = strval($value);
        }
        $this->value = $value;
        $this->valueHtml = htmlspecialchars($value);
        return $this;
    }


    public function label($label)
    {
        $this->label = htmlspecialchars($label);
        return $this;
    }


    public function required($bool = true)
    {
        if ($bool) {
            $this->props->set('required', true);
        } else {
            $this->props->remove('required');
        }
        return $this;
    }


    public function disabled($bool = true)
    {
        if ($bool) {
            $this->props->set('disabled', true);
        } else {
            $this->props->remove('disabled');
        }
        return $this;
    }


    public function readonly($bool = true)
    {
        if ($bool) {
            $this->props->set('readonly', true);
        } else {
            $this->props->remove('readonly');
        }
        return $this;
    }


    public function done()
    {
        return $this->form;
    }
}
