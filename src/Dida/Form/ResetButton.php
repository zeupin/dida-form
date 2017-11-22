<?php
/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files MUST retain the above copyright notice.
 */

namespace Dida\Form;

class ResetButton extends FormControl
{
    const VERSION = '20171120';


    use BeforeBuildTrait;


    protected function newCaptionZone()
    {
    }


    protected function newInputZone()
    {
        $this->inputZone->setTag('button', 'type="reset"');
    }


    public function build()
    {
        $this->beforeBuildButton();

        return parent::build();
    }
}
