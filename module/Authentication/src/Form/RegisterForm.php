<?php

namespace Authentication\Form;

use Zend\Form\Form;
use Zend\Form\Element\Csrf;

use Zend\Form\Element\Captcha;
//use ZfServiceReCaptcha2\Captcha\ReCaptcha2;


use Zend\Form\Element;
use ReCaptcha2\Captcha\ReCaptcha2;

use Zend\Captcha\ReCaptcha;

class RegisterForm extends Form
{
    public function __construct()
    {
        parent::__construct('register-form');

        $this->setAttributes([
            'class' => 'form-horizontal',
            'id' => 'form-register',
        ]);

        $this->createElements();
    }

    private function createElements()
    {
        $this->add([
            'name' => 'csrf',
            'type' => Csrf::class,
            'options' => [
                'crsf_options' => [
                    'timeout' => 600,
                ],
            ],
        ]);

        $this->add([
            'name' => 'name',
            'type' => 'text',
            'attributes' => [
                'class'    => 'form-control',
                'id'       => 'name',
                'required' => 'required',
            ],
            'options' => [
                'label' => 'Username',
                'label_attributes' => [
                    'class' => 'control-label asterisk',
                ],
                'min' => 2,
                'max' => 100,
            ],
        ]);

        $this->add([
            'name' => 'email',
            'type' => 'email',
            'attributes' => [
                'class'    => 'form-control',
                'id'       => 'email',
                'required' => 'required',
            ],
            'options' => [
                'label' => 'Email',
                'label_attributes' => [
                    'class' => 'control-label asterisk',
                ],
                'min' => 2,
                'max' => 100,
            ],
        ]);

        $this->add([
            'name' => 'password',
            'type' => 'password',
            'attributes' => [
                'class'    => 'form-control',
                'id'       => 'password',
                'required' => 'required',
            ],
            'options' => [
                'label' => 'Password',
                'label_attributes' => [
                    'class' => 'control-label asterisk',
                ],
                'min' => 2,
                'max' => 100,
            ],
        ]);

        $this->add([
            'name' => 'confirmPassword',
            'type' => 'password',
            'attributes' => [
                'class'    => 'form-control',
                'id'       => 'confirmPassword',
                'required' => 'required',
            ],
            'options' => [
                'label' => 'Confirm Password',
                'label_attributes' => [
                    'class' => 'control-label asterisk',
                ],
                'min' => 2,
                'max' => 100,
            ],
        ]);















        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'class' => 'btn btn-dark',
                'value' => 'Submit',
            ],
        ]);
    }
}
