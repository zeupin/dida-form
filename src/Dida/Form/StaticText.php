<?php
/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files MUST retain the above copyright notice.
 */

namespace Dida\Form;

class StaticText extends FormControl
{
    const VERSION = '20171117';

    public function build()
    {
        $output = [];

        if ($this->label) {
            $output[] = "<label>{$this->label}</label>";
        }

        $output[] = $this->valueHtml;

        return implode('', $output);
    }
}
