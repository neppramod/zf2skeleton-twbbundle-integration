<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/26/15
 * Time: 5:34 PM
 */

namespace Login\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Login\Model\Login;
use Login\Form\LoginForm;
use Zend\Authentication\Adapter\DbTable;

class LoginController extends AbstractActionController
{
    protected $loginTable;

    public function getLoginTable()
    {
        if (!$this->loginTable) {
            $sm = $this->getServiceLocator();
            $this->loginTable = $sm->get('Login\Model\LoginTable');
        }
        return $this->loginTable;
    }


    public function loginAction()
    {
        $form = new LoginForm();
        $form->get('submit')->setValue('Login');


        $request = $this->getRequest();
        if ($request->isPost()) {

            print_r($request->getPost());

            $post = $request->getPost();
            $username = $post['username'];
            $password = $post['password'];
            //print_r($username);
            echo "'".$username."'";
            echo "'".$password."'";
            echo "Hi";



            $login = new Login();
            $form->setInputFilter($login->getInputFilter());
            $form->setData($request->getPost());

            $user = "abc";
            $user = $this->getLoginTable()->getLoginbyusernamepassword($username, $password);

            if ($form->isValid()) {

                return $this->redirect()->toRoute('login', array(
                    'action' => 'loggedin'
                ));

            } else {
                foreach ($form->getMessages() as $messageId => $message) {
                    echo "Validation failure '$messageId': $message\n";
                }
            }

            /*
            if ($user != null) {
               // return $this->_helper->redirector('login', 'loginfail');
                return $this->_forward('loggedin');
            }
            */


        }

       // echo $form->getValue();

        return array('form' => $form, 'user' => $user);
    }



    /*
    public function loginAction()
    {
        $db = $this->_getParam('db');

        $loginForm = new Default_Form_Auth_Login($_POST);

        if ($loginForm->isValid()) {

           // $adapter = new Zend\Auth\Adapter\DbTable(
            $adapter = new DbTable(
                $db,
                'users',
                'username',
                'password',
                'MD5(CONCAT(?, password_salt))'
            );

            $adapter->setIdentity($loginForm->getValue('username'));
            $adapter->setCredential($loginForm->getValue('password'));

            $result = $auth->authenticate($adapter);

            if ($result->isValid()) {
                $this->_helper->FlashMessenger('Successful Login');
                $this->redirect('/');
                return;
            }

        }

        $this->view->loginForm = $loginForm;

    }

    */

    public function loggedinAction()
    {

    }

    public function loginfailAction()
    {

    }

    public function forminvalidAction()
    {

    }
}
