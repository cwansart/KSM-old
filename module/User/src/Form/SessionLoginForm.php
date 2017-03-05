<?php
namespace User\Form;

use Zend\Form\Form;

class SessionLoginForm extends Form
{

    public function __construct($name = null)
    {
        parent::__construct('user');

        $this->add([
            'name' => 'name',
            'type' => 'text',
            'options' => [
                'label' => 'Benutzername',
            ],
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'speichern',
            ],
        ]);

        $this->add([
            'name' => 'password',
            'type' => 'password',
            'options' => [
                'label' => 'Passwort',
            ],
        ]);
    }

}
