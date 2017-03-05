<?php
namespace User\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class UserTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getUser(int $id)
    {
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();

        if (!$row) {
            throw new RuntimeException('Could not find row with id ' . $id);
        }

        return $row;
    }

    public function saveUser(User $user)
    {
        $data = [
            'name' => $user->name,
            'password' => $user->password
        ];

        $id = (int) $user->id;
        if ($id === 0) {
            return $this->tableGateway->insert($data);
        }

        if (!$this->getUser($id)) {
            throw new RuntimeException('Cannot update user with ' . $user->name . '. Not found.');
        }
        $this->tableGateway->update($data, ['id' => $id]);
    }
    
    public function deleteUser(int $id)
    {
        if($id === 1) {
            throw new RuntimeException('Cannot delete user root.');
        }
        $this->tableGateway->delete(['id' => $id]);
    }
}
