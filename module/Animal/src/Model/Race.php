<?php
namespace Animal\Model;

class Race
{
    public $id;
    public $name;
    public $createdAt;

    public function exchangeArray(array $data)
    {
        $this->id = !empty($data['id']) ? $data['id'] : null;
        $this->name = !empty($data['name']) ? $data['name'] : null;
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
            'name' => 'race',
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
        
        return $inputFilter;
    }

    public function getArrayCopy()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

}
