<?php
/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files MUST retain the above copyright notice.
 */

namespace Dida\Form;

trait FormControlTrait
{
    protected $controls = [];

    protected $control_types = [
        'statictext' => 'Dida\\Form\\StaticText',

        'text'     => 'Dida\\Form\\Text',
        'password' => 'Dida\\Form\\Password',
        'hidden'   => 'Dida\\Form\\Hidden',
        'file'     => 'Dida\\Form\\File',

        'textarea' => 'Dida\\Form\\TextArea',

        'button'       => 'Dida\\Form\\Button',
        'resetbutton'  => 'Dida\\Form\\ResetButton',
        'submitbutton' => 'Dida\\Form\\SubmitButton',

        'select'        => 'Dida\\Form\\Select',
        'radiogroup'    => 'Dida\\Form\\RadioGroup',
        'checkboxgroup' => 'Dida\\Form\\CheckboxGroup',
    ];


    public function registerControlType($type, $class)
    {
        $type = strtolower($type);
        $this->control_types[$type] = $class;

        return $this;
    }


    public function &addControl($control, $index = null)
    {
        $control->setForm($this);

        if (is_null($index)) {
            $this->controls[] = $control;
        } else {
            $this->controls[$index] = $control;
        }

        return $control;
    }


    public function &add($type, $name = null, $data = null, $caption = null, $id = null, $index = null)
    {
        $type = strtolower($type);
        if (!array_key_exists($type, $this->control_types)) {
            throw new FormException($type, FormException::CONTROL_TYPE_NOT_FOUND);
        }

        $control = new $this->control_types[$type]($name, $data, $caption, $id);

        $this->addControl($control, $index);

        return $control;
    }


    public function &addStaticText($caption = null, $name = null, $data = null, $id = null, $index = null)
    {
        $control = new StaticText(null, $data, $caption, null);
        $this->addControl($control, $index);
        return $control;
    }


    public function &addText($caption = null, $name = null, $data = null, $id = null, $index = null)
    {
        $control = new Text($name, $data, $caption, $id);
        $this->addControl($control, $index);
        return $control;
    }


    public function &addPassword($caption = null, $name = null, $data = null, $id = null, $index = null)
    {
        $control = new Password($name, $data, $caption, $id);
        $this->addControl($control, $index);
        return $control;
    }


    public function &addHidden($caption = null, $name = null, $data = null, $id = null, $index = null)
    {
        $control = new Hidden($name, $data, null, $id);
        $this->addControl($control, $index);
        return $control;
    }


    public function &addFile($caption = null, $name = null, $data = null, $id = null, $index = null)
    {
        $control = new File($name, $data, $caption, $id);
        $this->addControl($control, $index);
        return $control;
    }


    public function &addTextArea($caption = null, $name = null, $data = null, $id = null, $index = null)
    {
        $control = new TextArea($name, $data, $caption, $id);
        $this->addControl($control, $index);
        return $control;
    }


    public function &addButton($caption = null, $name = null, $data = null, $id = null, $index = null)
    {
        $control = new Button($name, $data, $caption, $id);
        $this->addControl($control, $index);
        return $control;
    }


    public function &addResetButton($caption = null, $name = null, $data = null, $id = null, $index = null)
    {
        $control = new ResetButton($name, $data, $caption, $id);
        $this->addControl($control, $index);
        return $control;
    }


    public function &addSubmitButton($caption = null, $name = null, $data = null, $id = null, $index = null)
    {
        $control = new SubmitButton($name, $data, $caption, $id);
        $this->addControl($control, $index);
        return $control;
    }


    public function &addSelect($caption = null, $name = null, $data = null, $id = null, $index = null)
    {
        $control = new Select($name, $data, $caption, $id);
        $this->addControl($control, $index);
        return $control;
    }


    public function &addRadioGroup($caption = null, $name = null, $data = null, $id = null, $index = null)
    {
        $control = new RadioGroup($name, $data, $caption, $id);
        $this->addControl($control, $index);
        return $control;
    }


    public function &addCheckboxGroup($caption = null, $name = null, $data = null, $id = null, $index = null)
    {
        $control = new CheckboxGroup($name, $data, $caption, $id);
        $this->addControl($control, $index);
        return $control;
    }
}
