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
    const VERSION = '20171117';

    protected $options = [];

    protected $newoption = [
        'caption' => null,
        'value'   => null,
        'checked' => false,
    ];


    public function getAll()
    {
        return $this->options;
    }


    public function setValues(array $values)
    {
        foreach ($values as $index => $value) {
            if (!isset($this->options[$index])) {
                $this->options[$index] = $this->newoption;
            }
            $this->options[$index]['value'] = $value;
        }

        return $this;
    }


    public function setCaptions(array $captions)
    {
        foreach ($captions as $index => $caption) {
            if (!isset($this->options[$index])) {
                $this->options[$index] = $this->newoption;
            }
            $this->options[$index]['caption'] = $caption;
        }

        return $this;
    }


    public function setChecked(array $values)
    {
        foreach ($this->options as $index => $item) {
            if (isset($item['value'])) {
                $this->options[$index]['checked'] = (in_array($item['value'], $values));
                continue;
            } elseif (isset($item['caption'])) {
                $this->options[$index]['checked'] = (in_array($item['caption'], $values));
                continue;
            } else {
                $this->options[$index]['checked'] = false;
                continue;
            }
        }
    }


    public function resetChecked()
    {
        foreach ($this->options as $index => $item) {
            $this->options[$index]['checked'] = false;
        }
    }
}
