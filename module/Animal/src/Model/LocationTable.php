<?php
namespace Animal\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class LocationTable
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

    public function getLocation(int $id)
    {
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();

        if (!$row) {
            throw new RuntimeException('Could not find row with id ' . $id);
        }

        return $row;
    }

    public function saveLocation(Location $location)
    {
        $data = [
            'id' => $location->id,
            'name' => $location->name,
            'street' => $location->street,
            'house_number' => $location->houseNumber,
            'zip_code' => $location->zipCode,
            'city' => $location->city,
            'country' => $location->country,
        ];

        $id = (int) $location->id;
        if ($id === 0) {
            return $this->tableGateway->insert($data);
        }

        if (!$this->getLocation($id)) {
            throw new RuntimeException('Cannot update location with ' . $location->name . '. Not found.');
        }
        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteLocation(int $id)
    {
        $this->tableGateway->delete(['id' => $id]);
    }

}
