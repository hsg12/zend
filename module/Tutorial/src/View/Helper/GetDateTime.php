<?php

namespace Tutorial\View\Helper;

use Zend\View\Helper\AbstractHelper;

class GetDateTime extends AbstractHelper
{
    public function __invoke($time = false)
    {
        $res = '';
        $dt = new \DateTime('now', new \DateTimeZone('America/New_York'));

        if ($time) {
            $res = $dt->format("d F Y [H:i:s]");
        } else {
            $res = $dt->format('d F Y');
        }

        return $res ?: false;
    }
}
