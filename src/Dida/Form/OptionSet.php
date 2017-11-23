<?php
/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files MUST retain the above copyright notice.
 */

namespace Dida\Form;

class OptionSet
{
    const VERSION = '20171123';

    const CHECK_VALUE = 0;
    const CHECK_VALUE_OR_CAPTION = 1;

    protected $options = [];

    protected $newoption = [
        'caption'  => null,
        'value'    => null,
        'checked'  => false,
        'disabled' => false,
    ];


    public function add($index = null, $caption = null, $value = null, $checked = false, $disabled = false)
    {
        $option = [
            'caption'  => $caption,
            'value'    => $value,
            'checked'  => $checked,
            'disabled' => $disabled,
        ];

        if (is_null($index)) {
            $this->options[] = $option;
        } else {
            $this->options[$index] = $option;
        }

        return $this;
    }


    public function get($index, $key)
    {
        if (!array_key_exists($index, $this->options)) {
            return null;
        }

        if (array_key_exists($key, $this->options[$index])) {
            return null;
        }

        return $this->options[$index][$key];
    }


    public function set($index, $key, $value)
    {
        if (!array_key_exists($index, $this->options)) {
            $this->options[$index] = $this->newoption;
        }

        $this->options[$index][$key] = $value;

        return $this;
    }


    public function getAll()
    {
        return $this->options;
    }


    public function initOptions()
    {
        $this->options = [];
        return $this;
    }


    public function setOptions($options)
    {
        foreach ($options as $index => $option) {
            $origin = (array_key_exists($index, $this->options)) ? $this->options[$index] : [];
            $this->options[$index] = array_merge($this->newoption, $origin, $option);
        }

        return $this;
    }


    public function setOptionCaptions(array $array)
    {
        foreach ($array as $index => $value) {
            $this->set($index, 'caption', $value);
        }

        return $this;
    }


    public function setOptionValues(array $array)
    {
        foreach ($array as $index => $value) {
            $this->set($index, 'value', $value);
        }

        return $this;
    }


    public function setOptionCheckeds(array $array)
    {
        foreach ($array as $index => $value) {
            $this->set($index, 'checked', $value);
        }

        return $this;
    }


    public function setOptionDisableds(array $array)
    {
        foreach ($array as $index => $value) {
            $this->set($index, 'disabled', $value);
        }

        return $this;
    }


    public function check($data, $checktype = self::CHECK_VALUE)
    {
        if (is_null($data)) {
            return $this;
        }

        if (is_scalar($data)) {
            $data = [$data];
        }

        if (!is_array($data)) {
            throw new FormException(null, FormException::DATA_TYPE_ERROR);
        }

        if ($data === []) {
            return $this;
        }

        foreach ($this->options as $index => $option) {
            if ($this->get($index, 'disabled')) {
                continue;
            }

            if (isset($option['value'])) {
                $this->options[$index]['checked'] = (in_array($option['value'], $data));
                continue;
            } elseif (isset($option['caption']) && ($checktype === self::CHECK_VALUE_OR_CAPTION)) {
                $this->options[$index]['checked'] = (in_array($option['caption'], $data));
                continue;
            } else {
                $this->options[$index]['checked'] = null;
                continue;
            }
        }

        return $this;
    }
}
