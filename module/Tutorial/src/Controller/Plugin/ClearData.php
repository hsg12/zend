<?php

namespace Tutorial\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class ClearData extends AbstractPlugin
{
    public function clearStr($str)
    {
        $res = '';

        $filter = new \Zend\Filter\FilterChain();
        $filter->attachByName('HtmlEntities');
        $filter->attachByName('StringTrim');
        $res = $filter->filter($str);

        return $res;
    }

    public function clearInt($int, $abs = true)
    {
        $res = '';

        $filter = new \Zend\Filter\FilterChain();
        $filter->attachByName('Digits');

        if ($abs) {
            $res = abs($filter->filter($int));
        } else {
            $res = $filter->filter($int);
        }

        return $res;
    }
}
