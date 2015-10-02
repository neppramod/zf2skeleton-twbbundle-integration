<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/26/15
 * Time: 5:34 PM
 */

namespace Education\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Education\Model\Education;
use Education\Form\EducationForm;

class EducationController extends AbstractActionController
{
    protected $educationTable;

    public function getEducationTable()
    {
        if (!$this->educationTable) {
            $sm = $this->getServiceLocator();
            $this->educationTable = $sm->get('Education\Model\EducationTable');
        }
        return $this->educationTable;
    }

    public function indexAction()
    {
        return new ViewModel(
            array(
                'educations' => $this->getEducationTable()->fetchAll(),
            ));
    }

    public function addAction()
    {
        $form = new EducationForm();
        $form->get('submit')->setValue('Add/Submit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $education = new Education();
            $form->setInputFilter($education->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $education->exchangeArray($form->getData());
                $this->getEducationTable()->saveEducation($education);

                // Redirect to list of educations
                return $this->redirect()->toRoute('education');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRouter('education', array(
                'action' => 'add'
            ));
        }

        try {
            $education = $this->getEducationTable()->getEducation($id);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('education', array(
                'action' => 'index'
            ));
        }

        $form = new EducationForm();
        $form->bind($education);
        $form->get('submit')->setAttribute('value','Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($education->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {

                $this->getEducationTable()->saveEducation($education);

                // Redirect to list of educations
                return $this->redirect()->toRoute('education');
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
            return $this->redirect()->toRouter('education');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getEducationTable()->deleteEducation($id);
            }

            // Redirect to list of educations
            return $this->redirect()->toRoute('education');
        }

        return array(
            'id' => $id,
            'education' => $this->getEducationTable()->getEducation($id)
        );
    }
}
