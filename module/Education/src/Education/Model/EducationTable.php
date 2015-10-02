<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/26/15
 * Time: 6:21 PM
 */

namespace Education\Model;

use Zend\Db\TableGateway\TableGateway;

class EducationTable
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

    public function getEducation($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();

        if (!$row) {
            throw new \Exception("Could not find row $id");
        }

        return $row;
    }

    public function saveEducation(Education $education)
    {
        $data = array(
            'level' => $education->level,
            'description' => $education->description,
        );

        $id = (int) $education->id;

        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getEducation($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Education id does not exist');
            }
        }
    }

    public function deleteEducation($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}