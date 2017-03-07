<?php
namespace Animal\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class AnimalTable
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

    public function getAnimal(int $id)
    {
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();

        if (!$row) {
            throw new RuntimeException('Could not find row with id ' . $id);
        }

        return $row;
    }

    public function saveAnimal(Animal $animal)
    {
        $data = [
            'id' => $animal->id,
            'color' => $animal->color,
            'date_of_birth' => $animal->dateOfBirth,
            'is_male' => $animal->isMale,
            'is_castrated' => $animal->isCastrated,
            'castration_date' => $animal->castrationDate,
            'first_vaccination' => $animal->firstVaccination,
            'second_vaccination' => $animal->secondVaccination,
            'next_vaccination' => $animal->nextVaccination,
            'tattoo_left' => $animal->tattooLeft,
            'tattoo_right' => $animal->tattooRight,
            'chip' => $animal->chip,
            'distinguishing_marks' => $animal->distinguishingMarks,
            'comments' => $animal->comments,
            'deceased' => $animal->deceased,
            'cause_of_death' => $animal->causeOfDeath,
            'is_indoor_cat' => $animal->isIndoorCat,
            'is_outdoor_cat' => $animal->isOutdoorCat,
            'is_dog_friendly' => $animal->isDogFriendly,
            'is_child_friendly' => $animal->isChildFriendly,
            'image_path' => $animal->imagePath,
        ];

        $id = (int) $animal->id;
        if ($id === 0) {
            return $this->tableGateway->insert($data);
        }

        if (!$this->getAnimal($id)) {
            throw new RuntimeException('Cannot update user with ' . $animal->name . '. Not found.');
        }
        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteAnimal(int $id)
    {
        $this->tableGateway->delete(['id' => $id]);
    }

}
