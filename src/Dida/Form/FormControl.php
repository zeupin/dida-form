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
    const VERSION = '20171121';

    const TEXT = 'text';
    const HTML = 'html';

    protected $data = null;

    protected $bag = [];

    protected $form = null;

    protected $controlZone = null;

    protected $captionZone = null;

    protected $inputZone = null;

    protected $helpZone = null;

    protected $messageZone = null;


    abstract protected function newCaptionZone();


    abstract protected function newInputZone();


    public function __construct($name = null, $data = null, $caption = null, $id = null)
    {
        if (!is_null($name)) {
            $this->setName($name);
        }
        if (!is_null($data)) {
            $this->setData($data);
        }
        if (!is_null($caption)) {
            $this->setCaption($caption);
        }
        if (!is_null($id)) {
            $this->setID($id);
        }

        return $this;
    }


    public function setForm(&$form)
    {
        $this->form = $form;

        return $this;
    }


    public function &refControlZone()
    {
        if (!$this->controlZone) {
            $this->controlZone = new \Dida\Html\ActiveElement();
        }
        return $this->controlZone;
    }


    public function &refCaptionZone()
    {
        if (!$this->captionZone) {
            $this->captionZone = new \Dida\Html\ActiveElement();
            $this->newCaptionZone();
        }
        return $this->captionZone;
    }


    public function &refInputZone()
    {
        if (!$this->inputZone) {
            $this->inputZone = new \Dida\Html\ActiveElement();
            $this->newInputZone();
        }
        return $this->inputZone;
    }


    public function &refHelpZone()
    {
        if (!$this->helpZone) {
            $this->helpZone = new \Dida\Html\ActiveElement();
        }
        return $this->helpZone;
    }


    public function &refMessageZone()
    {
        if (!$this->messageZone) {
            $this->messageZone = new \Dida\Html\ActiveElement();
        }
        return $this->messageZone;
    }


    public function setName($name)
    {
        $this->bag['name'] = $name;
        return $this;
    }


    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }


    public function setCaption($caption, $type = self::TEXT)
    {
        if (is_null($caption)) {
            $this->bag['caption'] = $caption;
            return $this;
        }

        switch ($type) {
            case self::TEXT:
                $caption = htmlspecialchars($caption);
                $caption = nl2br($caption);
                break;
        }
        $this->bag['caption'] = $caption;
        return $this;
    }


    public function setID($id = null)
    {
        $this->bag['id'] = $id;
        return $this;
    }


    public function required($bool = true)
    {
        if ($bool) {
            $this->bag['required'] = true;
        } else {
            unset($this->bag['required']);
        }

        return $this;
    }


    public function done()
    {
        return $this->form;
    }


    public function build()
    {
        $output = [];
        if ($this->captionZone) {
            $output[] = $this->captionZone->build();
        }
        if ($this->inputZone) {
            $output[] = $this->inputZone->build();
        }
        if ($this->helpZone) {
            $output[] = $this->helpZone->build();
        }
        if ($this->messageZone) {
            $output[] = $this->messageZone->build();
        }

        $control = $this->refControlZone();
        $control->setInnerHTML(implode('', $output));
        return $control->build();
    }
}
