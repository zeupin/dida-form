<?php
/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files MUST retain the above copyright notice.
 */

namespace Dida\Form;

class Hidden extends FormControl
{
    const VERSION = '20171120';


    protected function newCaptionZone()
    {
    }


    protected function newInputZone()
    {
        $this->inputZone->setTag('input', 'type="hidden"');
    }


    protected function beforeBuild()
    {
        if (isset($this->bag['name'])) {
            $name = $this->bag['name'];
            $this->refInputZone()->setName($name);
        }

        if (isset($this->bag['id'])) {
            $id = $this->bag['id'];
            $this->refInputZone()->setID($id);
        }

        if (isset($this->data)) {
            $value = $this->data;
            $this->refInputZone()->setProp('value', htmlspecialchars($value));
        }
    }


    public function build()
    {
        $this->beforeBuild();

        return parent::build();
    }
}
