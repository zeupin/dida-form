<?php
/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files MUST retain the above copyright notice.
 */

namespace Dida\Form;

class TextArea extends FormControl
{
    const VERSION = '20171120';


    use BeforeBuildTrait;


    protected function newCaptionZone()
    {
        $this->captionZone->setTag('label');
    }


    protected function newInputZone()
    {
        $this->inputZone->setTag('textarea');
    }


    public function setRowsAndCols($rows = null, $cols = null)
    {
        $this->bag['rows'] = $rows;
        $this->bag['cols'] = $cols;
        return $this;
    }


    protected function beforeBuild()
    {
        $rows = (isset($this->bag['rows'])) ? $this->bag['rows'] : 6;
        $cols = (isset($this->bag['cols'])) ? $this->bag['cols'] : 40;
        $this->refInputZone()->setProp('cols', $cols)->setProp('rows', $rows);

        if (isset($this->data)) {
            $value = $this->data;
            $this->refInputZone()->setInnerHTML(htmlspecialchars($value));
        }
    }


    public function build()
    {
        $this->beforeBuildText();
        $this->beforeBuild();

        return parent::build();
    }
}
