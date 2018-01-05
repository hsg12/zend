<?php

namespace Blog\View\Helper;

use Zend\View\Helper\AbstractHelper;

class CheckImage extends AbstractHelper
{
    public function __invoke($img)
    {
        $file = getcwd() . '/public' . $img;
        if (is_file($file)) {
            return $file;
        } else {
            return '/img/home/no-image.jpg';
        }
    }
}
