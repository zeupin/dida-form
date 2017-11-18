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

class PropertySet
{
    protected $props = [
        'id'    => null,
        'name'  => null,
        'class' => [],
        'style' => [],
    ];

    protected $bool_prop_list = [
        'disabled'       => null,
        'readonly'       => null,
        'required'       => null,
        'hidden'         => null,
        'checked'        => null,
        'selected'       => null,
        'autofocus'      => null,
        'multiple'       => null,
        'formnovalidate' => null,
    ];


    public function __construct(array $props)
    {
        foreach ($props as $name => $value) {
            $this->set($name, $value);
        }
    }


    public function set($name, $value)
    {
        if (!is_string($name)) {
            throw new FormException($name, FormException::INVALID_PROPERTY_NAME);
        }

        if (!is_scalar($value) && !is_null($value)) {
            throw new FormException($name, FormException::INVALID_PROPERTY_VALUE);
        }

        $name = strtolower($name);

        if ($name === 'class') {
            $this->addClass($value);
            return $this;
        }

        if ($name === 'style') {
            $this->addStyle($value);
            return $this;
        }

        if (array_key_exists($name, $this->bool_prop_list)) {
            if ($value && ($value !== 'false')) {
                $this->props[$name] = true;
            } else {
                unset($this->props[$name]);
            }
            return $this;
        }

        $this->props[$name] = $value;
        return $this;
    }


    public function remove($name)
    {
        $name = strtolower($name);
        switch ($name) {
            case 'id':
            case 'name':
                $this->props[$name] = null;
                break;
            case 'class':
            case 'style':
                $this->props[$name] = [];
                break;
            default:
                unset($this->props[$name]);
        }

        return $this;
    }


    public function get($name)
    {
        if (!is_string($name)) {
            throw new FormException($name, FormException::INVALID_PROPERTY_NAME);
        }

        $name = strtolower($name);

        if (array_key_exists($name, $this->bool_prop_list)) {
            return array_key_exists($name, $this->props);
        }

        if (array_key_exists($name, $this->props)) {
            return $this->props[$name];
        } else {
            return null;
        }
    }


    public function addClass($class)
    {
        $class = trim($class);
        $classes = explode(' ', $class);
        foreach ($classes as $class) {
            $this->props['class'][$class] = $class;
        }

        return $this;
    }


    public function removeClass($class)
    {
        $class = trim($class);
        $classes = explode(' ', $class);
        foreach ($classes as $class) {
            unset($this->props['class'][$class]);
        }

        return $this;
    }


    public function addStyle($style)
    {
        $this->props['style'][] = $style;

        return $this;
    }


    protected function isBoolProp($name)
    {
        return array_key_exists($name, $this->bool_prop_list);
    }


    public function build(array $excludes = [])
    {
        $ex = array_fill_keys($excludes, true);

        $output = [];

        foreach ($this->props as $name => $value) {
            if ($value !== null) {
                if (array_key_exists($name, $ex)) {
                    continue;
                }

                if ($name === 'class') {
                    if ($this->props['class']) {
                        $class = implode(' ', $this->props['class']);
                        $output[] = " class=\"$class\"";
                    }
                } elseif ($name === 'style') {
                    if ($this->props['style']) {
                        $style = implode('', $this->props['style']);
                        $output[] = " style=\"$style\"";
                    }
                } elseif ($this->isBoolProp($name)) {
                    $output[] = " $name";
                } else {
                    $name = htmlspecialchars($name);
                    $value = htmlspecialchars($value);
                    $output[] = " $name=\"$value\"";
                }
            }
        }

        $str = implode('', $output);
        return $str;
    }
}
