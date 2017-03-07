<?php
namespace Animal\Model;

class Location
{
    public $id;
    public $name;
    public $street;
    public $houseNumber;
    public $zipCode;
    public $city;
    public $country;
    public $createdAt;

    public function exchangeArray(array $data)
    {
        $this->id = !empty($data['id']) ? $data['id'] : null;
        $this->name = !empty($data['name']) ? $data['name'] : null;
        $this->street = !empty($data['street']) ? $data['street'] : null;
        $this->houseNumber = !empty($data['house_number']) ? $data['house_number'] : null;
        $this->zipCode = !empty($data['zip_code']) ? $data['zip_code'] : null;
        $this->city = !empty($data['city']) ? $data['city'] : null;
        $this->country = !empty($data['country']) ? $data['country'] : null;
        $this->createdAt = !empty($data['created_at']) ? $data['created_at'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new DomainException(__CLASS__ . ' does not support changing the input filter.');
    }

    public static function getInputFilter()
    {
        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name' => 'location-name',
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
            'name' => 'location-street',
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
                        'max' => 30,
                    ],
                ]
            ],
        ]);

        $inputFilter->add([
            'name' => 'location-house-number',
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
                        'max' => 10,
                    ],
                ]
            ],
        ]);

        $inputFilter->add([
            'name' => 'location-zip-code',
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
            'name' => 'location-city',
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
                        'max' => 30,
                    ],
                ]
            ],
        ]);

        $inputFilter->add([
            'name' => 'location-country',
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
                        'max' => 60,
                    ],
                ]
            ],
        ]);
    }

    public function getArrayCopy()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'street' => $this->street,
            'house_number' => $this->houseNumber,
            'zip_code' => $this->zipCode,
            'city' => $this->city,
            'country' => $this->country,
        ];
    }

}
