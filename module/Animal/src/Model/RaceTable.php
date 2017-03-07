<?php
namespace Animal\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class RaceTable
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

    public function getRace(int $id)
    {
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();

        if (!$row) {
            throw new RuntimeException('Could not find row with id ' . $id);
        }

        return $row;
    }

    public function saveRace(Race $race)
    {
        $data = [
            'id' => $race->id,
            'name' => $race->name,
        ];

        $id = (int) $race->id;
        if ($id === 0) {
            return $this->tableGateway->insert($data);
        }

        if (!$this->getLocation($id)) {
            throw new RuntimeException('Cannot update race with ' . $race->name . '. Not found.');
        }
        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteRace(int $id)
    {
        $this->tableGateway->delete(['id' => $id]);
    }

}
