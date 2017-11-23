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
    const VERSION = '20171123';


    use OptionSetTrait;


    use BeforeBuildTrait;


    protected function newCaptionZone()
    {
        $this->captionZone->setTag('div');
    }


    protected function newInputZone()
    {
        $this->inputZone->setTag('div');
    }


    protected function beforeBuild()
    {
        if (isset($this->bag['caption'])) {
            $caption = $this->bag['caption'];
            $this->refCaptionZone()->setInnerHTML($caption);
        }

        if (isset($this->bag['required'])) {
            $this->refCaptionZone()->addChild()->setInnerHTML(' *');
        }

        if (is_scalar($this->data)) {
            $this->options->check($this->data);
        }

        $options = $this->options->getAll();

        $name = $this->bag['name'];
        foreach ($options as $option) {
            $this->refInputZone()
                ->addChild('label')
                ->addChild('input')->setProp('type', 'radio')
                ->setName($name)
                ->setProp('value', $option['value'])
                ->setProp('checked', $option['checked'])
                ->addAfter()->setInnerHTML($option['caption'])
            ;
        }
    }


    public function build()
    {
        $this->beforeBuild();

        return parent::build();
    }
}
