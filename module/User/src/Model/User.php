<?php
namespace User\Model;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;

class User
{
    private $inputAddFilter;
    private $inputEditFilter;
    public $id;
    public $name;
    public $created_at;
    public $password;

    public function exchangeArray(array $data)
    {
        $this->id = !empty($data['id']) ? $data['id'] : null;
        $this->name = !empty($data['name']) ? $data['name'] : null;
        $this->password = !empty($data['password']) ? $data['password'] : null;
        $this->created_at = !empty($data['created_at']) ? $data['created_at'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new DomainException(__CLASS__ . ' does not support changing the input filter.');
    }

    public static function getAddInputFilder()
    {
        $inputAddFilter = new InputFilter();
        $inputAddFilter->add([
            'name' => 'name',
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

        $inputAddFilter->add([
            'name' => 'password',
            'required' => true,
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 8,
                        'max' => 128,
                    ],
                ]
            ],
        ]);

        return $inputAddFilter;
    }

    public function getAddInputFilter()
    {
        if (!$this->inputAddFilter) {
            $this->inputAddFilter = $this::getAddInputFilder();
        }

        return $this->inputAddFilter;
    }

    public function getEditInputFilter()
    {
        if (!$this->inputEditFilter) {
            $this->inputEditFilter = new InputFilter();

            $this->inputEditFilter->add([
                'name' => 'name',
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
        }

        return $this->inputEditFilter;
    }

    public function getArrayCopy()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
//            'password' => $this->password,
//            'created_at' => $this->created_at,
        ];
    }

}
