<?php
namespace Animal\Model;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\Date;
use Zend\Validator\StringLength;

class Animal
{
    public $id;
    public $breed;
    public $name;
    public $color;
    public $dateOfBirth;
    public $isMale;
    public $location;
    public $isCastrated;
    public $castrationDate;
    public $firstVaccination;
    public $secondVaccination;
    public $nextVaccination;
    public $tattooLeft; // 5 chars
    public $tattooRight; // 5 chars
    public $chip; // 15 chars
    public $distinguishingMarks;
    public $comments;
    public $deceased;
    public $causeOfDeath;
    public $isIndoorCat;
    public $isOutdoorCat;
    public $isCatFriendly;
    public $isDogFriendly;
    public $isChildFriendly;
    public $imagePath;
    public $createdAt;
    public $inputFilter;

    public function exchangeArray(array $data)
    {
        $this->id = !empty($data['id']) ? $data['id'] : null;
        $this->breed = !empty($data['breed']) ? $data['breed'] : null;
        $this->name = !empty($data['name']) ? $data['name'] : null;
        $this->color = !empty($data['color']) ? $data['color'] : null;
        $this->dateOfBirth = !empty($data['date_of_birth']) ? $data['date_of_birth'] : null;
        $this->isMale = !empty($data['is_male']) ? (bool) $data['is_male'] : true;
        $this->location = !empty($data['location']) ? $data['location'] : null;
        $this->isCastrated = !empty($data['is_castrated']) ? $data['is_castrated'] : false;
        $this->castrationDate = !empty($data['castration_date']) ? $data['castration_date'] : null;
        $this->firstVaccination = !empty($data['first_vaccation']) ? $data['first_vaccation'] : null;
        $this->secondVaccination = !empty($data['second_vaccation']) ? $data['second_vaccation'] : null;
        $this->nextVaccination = !empty($data['next_vaccation']) ? $data['next_vaccation'] : null;
        $this->tattooLeft = !empty($data['tattoo_left']) ? $data['tattoo_left'] : null;
        $this->tattooRight = !empty($data['tattoo_right']) ? $data['tattoo_right'] : null;
        $this->chip = !empty($data['chip']) ? $data['chip'] : null;
        $this->distinguishingMarks = !empty($data['distinguishing_marks']) ? $data['distinguishing_marks'] : null;
        $this->comments = !empty($data['comments']) ? $data['comments'] : null;
        $this->deceased = !empty($data['deceased']) ? (bool) $data['deceased'] : false;
        $this->causeOfDeath = !empty($data['cause_of_death']) ? $data['cause_of_death'] : null;
        $this->isIndoorCat = !empty($data['is_indoor_cat']) ? (bool) $data['is_indoor_cat'] : false;
        $this->isOutdoorCat = !empty($data['is_outdoor_cat']) ? (bool) $data['is_outdoor_cat'] : false;
        $this->isCatFriendly = !empty($data['is_cat_friendly']) ? (bool) $data['is_cat_friendly'] : false;
        $this->isDogFriendly = !empty($data['is_dog_friendly']) ? (bool) $data['is_dog_friendly'] : false;
        $this->isChildFriendly = !empty($data['is_child_friendly']) ? (bool) $data['is_child_friendly'] : false;
        $this->imagePath = !empty($data['image_path']) ? $data['image_path'] : null;
        $this->createdAt = !empty($data['created_at']) ? $data['created_at'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new DomainException(__CLASS__ . ' does not support changing the input filter.');
    }

    public function getInputFilter()
    {
        if ($this->inputFilter) {
            return $this->inputFilter;
        }
        
        $inputFilter = new InputFilter();
        $inputFilter->add([
            'name' => 'breed',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ],
                ]
            ],
        ]);
        
        $inputFilter->add([
            'name' => 'name',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max' => 50,
                    ],
                ]
            ],
        ]);

        $inputFilter->add([
            'name' => 'color',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 50,
                    ],
                ]
            ],
        ]);

        $inputFilter->add([
            'name' => 'date-of-birth',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max' => 50,
                    ],
                ]
            ],
        ]);

        $inputFilter->add([
            'name' => 'is-male',
            'required' => false,
            'filters' => [
                [
                    'name' => \Zend\Filter\Boolean::class,
                    'options' => [
                        'casting' => 'TRUE',
                        'type' => 'integer',
                    ],
                ]
            ],
        ]);

        $inputFilter->add([
            'name' => 'is-castrated',
            'required' => false,
            'filters' => [
                [
                    'name' => \Zend\Filter\Boolean::class,
                    'options' => [
                        'casting' => 'TRUE',
                        'type' => 'integer',
                    ],
                ]
            ],
        ]);

        $inputFilter->add([
            'name' => 'castration-date',
            'required' => false,
            'validators' => [
                [
                    'name' => Date::class,
                ]
            ],
        ]);

        $inputFilter->add([
            'name' => 'first-vaccination',
            'required' => false,
            'validators' => [
                [
                    'name' => Date::class,
                ]
            ],
        ]);

        $inputFilter->add([
            'name' => 'second-vaccination',
            'required' => false,
            'validators' => [
                [
                    'name' => Date::class,
                ]
            ],
        ]);

        $inputFilter->add([
            'name' => 'next-vaccination',
            'required' => false,
            'validators' => [
                [
                    'name' => Date::class,
                ]
            ],
        ]);

        $inputFilter->add([
            'name' => 'tattoo-left',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max' => 5,
                    ],
                ]
            ],
        ]);
        
        $inputFilter->add([
            'name' => 'tattoo-right',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max' => 5,
                    ],
                ]
            ],
        ]);

        $inputFilter->add([
            'name' => 'chip',
            'required' => false,
            'filters' => [
                ['name' => \Zend\Filter\Digits::class],
            ],
            'validators' => [
                [
                    'name' => \Zend\Validator\Digits::class,
                ]
            ],
        ]);

        $inputFilter->add([
            'name' => 'distinguishing-marks',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);

        $inputFilter->add([
            'name' => 'comments',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);

        $inputFilter->add([
            'name' => 'deceased',
            'required' => false,
            'filters' => [
                [
                    'name' => \Zend\Filter\Boolean::class,
                    'options' => [
                        'casting' => 'TRUE',
                        'type' => 'integer',
                    ],
                ]
            ],
        ]);

        $inputFilter->add([
            'name' => 'deceased',
            'required' => false,
            'filters' => [
                [
                    'name' => \Zend\Filter\Boolean::class,
                    'options' => [
                        'casting' => 'TRUE',
                        'type' => 'integer',
                    ],
                ]
            ],
        ]);

        $inputFilter->add([
            'name' => 'cause-of-death',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);

        $inputFilter->add([
            'name' => 'is-indoor-cat',
            'required' => false,
            'filters' => [
                [
                    'name' => \Zend\Filter\Boolean::class,
                    'options' => [
                        'casting' => 'TRUE',
                        'type' => 'integer',
                    ],
                ]
            ],
        ]);

        $inputFilter->add([
            'name' => 'is-outdoor-cat',
            'required' => false,
            'filters' => [
                [
                    'name' => \Zend\Filter\Boolean::class,
                    'options' => [
                        'casting' => 'TRUE',
                        'type' => 'integer',
                    ],
                ]
            ],
        ]);

        $inputFilter->add([
            'name' => 'is-cat-friendly',
            'required' => false,
            'filters' => [
                [
                    'name' => \Zend\Filter\Boolean::class,
                    'options' => [
                        'casting' => 'TRUE',
                        'type' => 'integer',
                    ],
                ]
            ],
        ]);
        
        $inputFilter->add([
            'name' => 'is-dog-friendly',
            'required' => false,
            'filters' => [
                [
                    'name' => \Zend\Filter\Boolean::class,
                    'options' => [
                        'casting' => 'TRUE',
                        'type' => 'integer',
                    ],
                ]
            ],
        ]);

        $inputFilter->add([
            'name' => 'is-child-friendly',
            'required' => false,
            'filters' => [
                [
                    'name' => \Zend\Filter\Boolean::class,
                    'options' => [
                        'casting' => 'TRUE',
                        'type' => 'integer',
                    ],
                ]
            ],
        ]);

        // @TODO: add filter for image_path

        // We don't need the location for now...
        // @TODO: add the location filter
        //$locationInputFilter = Location::getInputFilter();
        //$inputFilter->merge($locationInputFilter);
        
        $this->inputFilter = $inputFilter;
        return $inputFilter;
    }

    public function getArrayCopy()
    {
        return [
            'id' => $this->id,
            'breed' => $this->breed,
            'name' => $this->name,
            'color' => $this->color,
            'date_of_birth' => $this->dateOfBirth,
            'is_male' => $this->isMale,
            'is_castrated' => $this->isCastrated,
            'castration_date' => $this->castrationDate,
            'first_vaccination' => $this->firstVaccination,
            'second_vaccination' => $this->secondVaccination,
            'next_vaccination' => $this->nextVaccination,
            'tattoo_left' => $this->tattooLeft,
            'tattoo_right' => $this->tattooRight,
            'chip' => $this->chip,
            'distinguishing_marks' => $this->distinguishingMarks,
            'comments' => $this->comments,
            'deceased' => $this->deceased,
            'cause_of_death' => $this->causeOfDeath,
            'is_indoor_cat' => $this->isIndoorCat,
            'is_outdoor_cat' => $this->isOutdoorCat,
            'is_cat_friendly' => $this->isCatFriendly,
            'is_dog_friendly' => $this->isDogFriendly,
            'is_child_friendly' => $this->isChildFriendly,
            'image_path' => $this->imagePath,
        ];
    }

}
