<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/26/15
 * Time: 5:34 PM
 */

namespace Person\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Person\Model\Person;
use Person\Form\PersonForm;

class PersonController extends AbstractActionController
{
    protected $personTable;

    public function getPersonTable()
    {
        if (!$this->personTable) {
            $sm = $this->getServiceLocator();
            $this->personTable = $sm->get('Person\Model\PersonTable');
        }
        return $this->personTable;
    }

    public function indexAction()
    {
        return new ViewModel(
            array(
                'persons' => $this->getPersonTable()->fetchAll(),
            ));
    }

    public function addAction()
    {
        $form = new PersonForm();
        $form->get('submit')->setValue('Add/Submit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $person = new Person();
            $form->setInputFilter($person->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $person->exchangeArray($form->getData());
                $this->getPersonTable()->savePerson($person);

                // Redirect to list of persons
                return $this->redirect()->toRoute('person');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRouter('person', array(
                'action' => 'add'
            ));
        }

        try {
            $person = $this->getPersonTable()->getPerson($id);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('person', array(
                'action' => 'index'
            ));
        }

        $form = new PersonForm();
        $form->bind($person);
        $form->get('submit')->setAttribute('value','Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($person->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {

                $this->getPersonTable()->savePerson($person);

                // Redirect to list of persons
                return $this->redirect()->toRoute('person');
            }
        }
        return array(
            'id' => $id,
            'form' => $form
        );
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRouter('person');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getPersonTable()->deletePerson($id);
            }

            // Redirect to list of persons
            return $this->redirect()->toRoute('person');
        }

        return array(
            'id' => $id,
            'person' => $this->getPersonTable()->getPerson($id)
        );
    }
}
