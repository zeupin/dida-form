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
    const VERSION = '20171117';


    public function value($value)
    {
        parent::value($value);

        $this->setProp('value', $value);
        return $this;
    }


    public function build()
    {
        return '<input type="hidden"' . $this->props->build() . '>';
    }
}
