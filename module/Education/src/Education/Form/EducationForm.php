<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/26/15
 * Time: 6:28 PM
 */

namespace Education\Form;


use Zend\Form\Form;

class EducationForm extends Form
{
    public function __construct($name = null)
    {
        // We want to ignore the name passed
        parent::__construct('education');

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'level',
            'type' => 'Text',
            //'class' => 'form-control',
            'options' => array(
                'label' => 'Level',
            ),
        ));

        $this->add(array(
            'name' => 'description',
            'type' => 'Text',
            //'class' => 'form-control',
            'options' => array(
                'label' => 'Description',
            ),
        ));



        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
                'class' => 'btn btn-primary'
            ),
        ));
    }
}