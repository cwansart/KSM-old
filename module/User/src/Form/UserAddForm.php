<?php
namespace User\Form;

class UserAddForm extends UserEditForm
{
    public function __construct($name = null)
    {
        parent::__construct('user');

        $this->add([
            'name' => 'password',
            'type' => 'password',
            'options' => [
                'label' => 'Passwort',
            ],
        ]);
    }
}
