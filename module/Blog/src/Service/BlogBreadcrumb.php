<?php

namespace Blog\Service;

use Zend\Navigation\Service\DefaultNavigationFactory;

class BlogBreadcrumb extends DefaultNavigationFactory
{
    protected function getName()
    {
        return 'blog_breadcrumb';
    }
}
