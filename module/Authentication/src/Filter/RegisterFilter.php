<?php

namespace Authentication\Filter;

use Zend\InputFilter\InputFilter;

class RegisterFilter extends InputFilter
{
    public function __construct()
    {
        $this->add([
            'name' => 'name',
            'required' => true,
            'filters' => [
                ['name' => 'stripTags'],
                ['name' => 'stringTrim'],
            ],
            'validators' => [
                [
                    'name' => 'stringLength',
                    'options' => [
                        'encoding' => 'utf-8',
                        'min' => 2,
                        'max' => 100,
                    ],
                ]
            ],
        ]);

        $this->add([
            'name' => 'email',
            'required' => true,
            'filters' => [
                ['name' => 'stripTags'],
                ['name' => 'stringTrim'],
            ],
            'validators' => [
                [
                    'name' => 'emailAddress',
                    'options' => [
                        'encoding' => 'utf-8',
                        'min' => 2,
                        'max' => 100,
                    ],
                ]
            ],
        ]);

        $this->add([
            'name' => 'password',
            'required' => true,
            'filters' => [
                ['name' => 'stripTags'],
                ['name' => 'stringTrim'],
            ],
            'validators' => [
                [
                    'name' => 'stringLength',
                    'options' => [
                        'encoding' => 'utf-8',
                        'min' => 2,
                        'max' => 100,
                    ],
                ]
            ],
        ]);

        $this->add([
            'name' => 'confirmPassword',
            'required' => true,
            'filters' => [
                ['name' => 'stripTags'],
                ['name' => 'stringTrim'],
            ],
            'validators' => [
                [
                    'name' => 'identical',
                    'options' => [
                        'token' => 'password',
                    ],
                ]
            ],
        ]);
    }
}
