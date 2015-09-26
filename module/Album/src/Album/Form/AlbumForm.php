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


        // Lets add custom fields
        $this->add(array(
           'name' => 'input-email',
            'attributes' => array(
                'type' => 'email',
                'placeholder' => 'Enter email',
                'id' => 'exampleInputEmail1'
            ),
            'options' => array('label' => 'Email address')
        ));

        $this->add(array(
            'name' => 'input-password',
            'attributes' => array(
                'type' => 'password',
                'placeholder' => 'Password',
                'id' => 'exampleInputPassword1',
                'class' => 'input-sm'
            ),
            'options' => array(
                'label' => 'Password',
                'validation-state' => 'warning',
                )
        ));


        $this->add(array(
            'name' => 'another-button',
            'attributes' => array(
                'type' => 'button',
                'class' => 'btn-primary btn-lg',
                'value' => 'Btn'
            ),
            'twb-layout' => 'inline',
            'icon' => 'star',
        ));




        $this->add(
            array(
                'name' => 'input-file',
                'attributes' => array(
                    'type' => 'file',
                    'id' => 'exampleInputFile'
                ),
                'options' => array(
                    'label' => 'File input',
                    'help-block' => 'Example block-level help text here.'
                )
            ));

        $aDropDownOptions = array(
            'items' => array(
                'Action',
                'Another action',
                'Something else here',
                \TwbBundle\View\Helper\TwbBundleDropDown::TYPE_ITEM_DIVIDER,
                'Separated link'
            )
        );

        $oButton = new \Zend\Form\Element\Button('default',array('label' => 'Default','dropdown' => $aDropDownOptions));
        $this->add($oButton);




        $this->add(array(
            'name' => 'input-checkbox',
            'type' => 'checkbox',
            'options' => array('label' => 'Check me out')
        ));

        $this->add(array(
            'name' => 'fancy-button',
            'type' => 'button',
            'options' => array('label' => 'Info'),
            'attributes' => array(
                'class', 'btn-primary',

            )
        ));




        $this->add(array(
            'name' => 'optionsRadios',
            'type' => 'MultiCheckbox',
            'options' => array(
                'value_options' => array(
                    array('label' => '1','value' => 'option1', 'attributes' => array('id' => 'inlineCheckbox1')),
                    array('label' => '2','value' => 'option2', 'attributes' => array('id' => 'inlineCheckbox2')),
                    array('label' => '3','value' => 'option3', 'attributes' => array('id' => 'inlineCheckbox3'))
                )
            )
        ));

        $this->add(array(
            'name' => 'optionsRadiosNoInline',
            'type' => 'MultiCheckbox',
            'options' => array(
                'value_options' => array(
                    array('label' => '1','value' => 'option1', 'attributes' => array('id' => 'noInlineCheckbox1')),
                    array('label' => '2','value' => 'option2', 'attributes' => array('id' => 'noInlineCheckbox2')),
                    array('label' => '3','value' => 'option3', 'attributes' => array('id' => 'noInlineCheckbox3'))
                ),
                'inline' => false
            )
        ));


        $this->add(array(
            'name' => 'select',
            'type' => 'select',
            'options' => array('value_options' => array(1,2,3,4,5))
        ));

        $this->add(array(
            'name' => 'multiple-select',
            'type' => 'select',
            'options' => array('value_options' => array(1,2,3,4,5)),
            'attributes' => array('multiple' => true)
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