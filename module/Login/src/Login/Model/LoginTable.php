<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/26/15
 * Time: 6:21 PM
 */

namespace Login\Model;

use Zend\Db\TableGateway\TableGateway;

class LoginTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getLogin($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();

        if (!$row) {
            throw new \Exception("Could not find row $id");
        }

        return $row;
    }

    public function getLoginbyusernamepassword($username, $password)
    {
        $username = trim($username);
        $password = trim($password);
        /*
        $rowset = $this->tableGateway->select(array(
            'username' => $username,
            'password' => $password,
        ));
        */
        $id = (int) 1;
        //$rowset = $this->tableGateway->select(array('id' => $id));
        //$rowset = $this->tableGateway->select(array('username' => 'root'));
        $rowset = $this->tableGateway->select(array('username' => $username));
        $row = $rowset->current();

        if (!$row) {
            throw new \Exception("Could not find user");
        }

        return $row;
    }

    public function saveLogin(Login $login)
    {
        $data = array(
            'name' => $login->name,
            'username' => $login->username,
            'password' => $login->password,
        );

        $id = (int) $login->id;

        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getLogin($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Login id does not exist');
            }
        }
    }

    public function deleteLogin($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}