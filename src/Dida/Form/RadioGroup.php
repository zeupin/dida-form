<?php
/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files MUST retain the above copyright notice.
 */

namespace Dida\Form;

class RadioGroup extends FormControl
{
    protected $defaultValue = null;

    protected $options = [];


    public function options(array $options)
    {
        $this->options = $options;
        return $this;
    }


    public function defaultValue($value)
    {
        $this->defaultValue = $value;
        return $this;
    }


    public function build()
    {
        $output = [];

        $name = $this->props->get('name');
        $for = ($name) ? " for=\"{$name}\"" : '';
        $required = ($this->props->get('required')) ? ' *' : '';

        if ($this->label) {
            $output[] = "<label{$for}>{$this->label}{$required}</label>";
        }

        if (is_null($this->value)) {
            $value = $this->defaultValue;
        } else {
            $value = $this->value;
        }

        $props = $this->props->build(['id']);
        foreach ($this->options as $caption => $option) {
            if (is_int($caption)) {
                $caption = $option;
            }
            $optionstr = ' value="' . htmlspecialchars($option) . '"';
            $checked = ("{$value}" == "$option") ? ' checked' : '';
            $caption = htmlspecialchars($caption);
            $output[] = "<input type=\"radio\"{$props}{$optionstr}{$checked}>{$caption}";
        }

        return implode('', $output);
    }
}
