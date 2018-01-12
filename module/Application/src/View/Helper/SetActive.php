<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

class SetActive extends AbstractHelper
{
    public function __invoke($obj, $value)
    {
        if ($obj->headTitle()->renderTitle() === $value) {
            return 'home-active';
        }
    }
}
