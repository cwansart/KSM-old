<?php
namespace Animal\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class AnimalDeleteForm extends Form
{

    public function __construct($name = null)
    {
        parent::__construct('animal');
        
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'löschen',
            ],
        ]);
    }

}
