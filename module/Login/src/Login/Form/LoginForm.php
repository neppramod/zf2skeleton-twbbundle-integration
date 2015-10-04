<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/26/15
 * Time: 6:28 PM
 */

namespace Login\Form;


use Zend\Form\Form;

class LoginForm extends Form
{
    public function __construct($name = null)
    {
        // We want to ignore the name passed
        parent::__construct('login');

        /*
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        */

        $this->add(array(
            'name' => 'username',
            'type' => 'Text',
            'options' => array(
                'label' => 'Username',
            ),
        ));

        $this->add(array(
            'name' => 'password',
            'type' => 'Password',
            'options' => array(
                'label' => 'Password',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'options' => array(
                'label' => 'Login',
            ),
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
                'class' => 'btn btn-primary'
            ),
        ));
    }
}