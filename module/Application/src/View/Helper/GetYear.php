<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

class GetYear extends AbstractHelper
{
    public function __invoke()
    {
        $dt = new \DateTime('now', new\DateTimeZone('America/New_York'));
        $year = $dt->format('Y');

        return ($year > 2017) ? "2017 - {$year}" : $year;
    }
}
