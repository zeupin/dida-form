<?php
/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files MUST retain the above copyright notice.
 */

namespace Dida\Form;

class Select extends FormControl
{
    const VERSION = '20171120';


    use \Dida\Form\OptionSetTrait;


    use BeforeBuildTrait;


    protected function newCaptionZone()
    {
        $this->captionZone->setTag('label');
    }


    protected function newInputZone()
    {
        $this->inputZone->setTag('select');
    }


    protected function beforeBuild()
    {
        $options = $this->options->getAll();

        foreach ($options as $option) {
            $opt = $this->refInputZone()->addChild('option');
            $opt->setInnerHTML($option['caption'])
                ->setProp('value', $option['value'])
                ->setProp('selected', $option['checked']);
        }
    }


    public function build()
    {
        $this->beforeBuildText();
        $this->beforeBuild();

        return parent::build();
    }
}
