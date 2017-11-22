<?php
/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files MUST retain the above copyright notice.
 */

namespace Dida\Form;

class Button extends FormControl
{
    const VERSION = '20171120';


    use BeforeBuildTrait;


    protected function newCaptionZone()
    {
    }


    protected function newInputZone()
    {
        $this->inputZone->setTag('button', 'type="button"');
    }


    public function build()
    {
        $this->beforeBuildButton();

        return parent::build();
    }
}
