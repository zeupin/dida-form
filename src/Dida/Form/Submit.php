<?php
/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files MUST retain the above copyright notice.
 */

namespace Dida\Form;

class Submit extends FormControl
{
    const VERSION = '20171118';

    protected $value = null;


    public function build()
    {
        $output = [];

        $output[] = '<button type="submit"';
        $output[] = $this->props->build();
        if (isset($this->valueHtml)) {
            $output[] = ' value="' . $this->valueHtml . '"';
        }
        $output[] = '>';

        if (isset($this->label)) {
            $output[] = $this->label;
        }

        $output[] = "</button>";

        return implode('', $output);
    }
}
