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
            throw new ModelNotFoundException('Could not find row with id ' . $id);
        }

        return $row;
    }

    public function saveAnimal(Animal $animal)
    {
        $data = [
            'registration_date' => $animal->registrationDate,
            'breed' => $animal->breed,
            'color' => $animal->color,
            'name' => $animal->name,
            'date_of_birth' => $animal->dateOfBirth,
            'location' => $animal->location,
            'street' => $animal->street,
            'house_number' => $animal->houseNumber,
            'zip_code' => $animal->zip_code,
            'city' => $animal->city,
            'country' => $animal->country,
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
            'is_cat_friendly' => $animal->isCatFriendly,
            'is_dog_friendly' => $animal->isDogFriendly,
            'is_child_friendly' => $animal->isChildFriendly,
            'image_path' => $animal->imagePath,
        ];

        $id = (int) $animal->id;
        if ($id === 0) {
            return $this->tableGateway->insert($data);
        }

        if (!$this->getAnimal($id)) {
            throw new RuntimeException('Cannot update animal with ' . $animal->name . '. Not found.');
        }
        $this->tableGateway->update($data, ['id' => $id]);
        return $id;
    }

    public function deleteAnimal(int $id)
    {
        $this->tableGateway->delete(['id' => $id]);
    }

}
