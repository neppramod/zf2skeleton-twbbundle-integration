<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/19/15
 * Time: 4:41 PM
 */

namespace Album\Form;


use Zend\Form\Form;

class AlbumForm extends Form
{
    public function __construct($name = null)
    {
        // We want to ignore the name passed
        parent::__construct('album');

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'title',
            'type' => 'Text',
            //'class' => 'form-control',
            'options' => array(
                'label' => 'Title',
            ),
        ));

        $this->add(array(
            'name' => 'artist',
            'type' => 'Text',
            //'class' => 'form-control',
            'options' => array(
                'label' => 'Artist',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
                //'class' => 'btn btn-default'
            ),
        ));
    }
}