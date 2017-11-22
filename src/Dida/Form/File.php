<?php
/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files MUST retain the above copyright notice.
 */

namespace Dida\Form;

class File extends FormControl
{
    const VERSION = '20171120';


    use BeforeBuildTrait;


    protected function newCaptionZone()
    {
        $this->captionZone->setTag('label');
    }


    protected function newInputZone()
    {
        $this->inputZone->setTag('input', 'type="file"');
    }


    protected function beforeBuild()
    {
    }


    public function build()
    {
        $this->beforeBuildText();
        $this->beforeBuild();

        return parent::build();
    }
}
