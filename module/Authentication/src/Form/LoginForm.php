<?php

namespace Authentication\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class LoginForm extends Form
{
    public function __construct()
    {
        parent::__construct('login-form');

        $this->setAttributes([
            'class' => 'form-horizontal',
        ]);

        $this->createElements();
    }

    private function createElements()
    {
        $csrf = new Element\Csrf('csrf');
        $csrf->setOptions([
            'crsf_options' => [
                'timeout' => 600,
            ],
        ]);
        $this->add($csrf);

        $name = new Element\Text('name');
        $name->setLabel('Username');
        $name->setAttributes([
            'class'    => 'form-control',
            'id'       => 'name',
            'required' => 'required',
        ]);
        $name->setOptions([
            'min' => 2,
            'max' => 100,
        ]);
        $this->add($name);

        $password = new Element\Password('password');
        $password->setLabel('Password');
        $password->setAttributes([
            'class'    => 'form-control',
            'id'       => 'password',
            'required' => 'required',
        ]);
        $password->setOptions([
            'min' => 2,
            'max' => 100,
        ]);
        $this->add($password);

        $rememberMe = new Element\Checkbox('rememberMe');
        //$rememberMe->setLabel('Remember Me');
        $rememberMe->setAttributes([
            'id'       => 'rememberMe',
        ]);
        $rememberMe->setOptions([
            'label' => 'Remember Me',
            'use_hidden_element' => true,
            'checked_value' => 1,
            'unchecked_value' => 0,
        ]);
        $this->add($rememberMe);

        $submit = new Element\Submit('submit');
        $submit->setAttributes([
            'class' => 'btn btn-default',
            'value' => 'Submit',
        ]);
        $this->add($submit);
    }
}
