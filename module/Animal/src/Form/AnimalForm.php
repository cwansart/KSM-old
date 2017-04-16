<?php
namespace Animal\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class AnimalForm extends Form
{

    public function __construct($name = null)
    {
        parent::__construct('animal');

        $this->add([
            'name' => 'registration-date',
            'type' => Element\Date::class,
            'options' => [
                'label' => 'Registrationsdatum',
            ],
        ]);

        $this->add([
            'name' => 'leave-date',
            'type' => Element\Date::class,
            'options' => [
                'label' => 'Ausgangsdatum',
            ],
        ]);

        $this->add([
            'name' => 'breed',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Rasse',
            ],
        ]);
        
        $this->add([
            'name' => 'name',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Name',
            ],
        ]);

        $this->add([
            'name' => 'color',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Farbe',
            ]
        ]);

        $this->add([
            'name' => 'date-of-birth',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Geburtsdatum',
            ],
        ]);

        $this->add([
            'type' => Element\Radio::class,
            'name' => 'is-male',
            'options' => [
                'label' => 'Geschlecht',
                'value_options' => [
                    [
                        'value' => 'm',
                        'label' => 'männlich',
                        'selected' => true,
                    ],
                    [
                        'value' => 'f',
                        'label' => 'weiblich',
                    ],
                ],
            ],
        ]);

        $this->add([
            'name' => 'location',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Aufenthaltsort',
            ],
        ]);

        $this->add([
            'name' => 'street',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Straße',
            ],
        ]);

        $this->add([
            'name' => 'house-number',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Hausnummer',
            ],
        ]);

        $this->add([
            'name' => 'zip-code',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'PLZ',
            ],
        ]);

        $this->add([
            'name' => 'city',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Stand',
            ],
        ]);

        $this->add([
            'name' => 'country',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Land',
            ],
        ]);

        $this->add([
            'type' => Element\Radio::class,
            'name' => 'is-castrated',
            'options' => [
                'label' => 'Kastriert',
                'value_options' => [
                    [
                        'value' => 'y',
                        'label' => 'ja',
                    ],
                    [
                        'value' => 'n',
                        'label' => 'nein',
                        'selected' => true,
                    ],
                ],
            ],
        ]);

        $this->add([
            'name' => 'distinguishing-marks',
            'type' => Element\Textarea::class,
            'options' => [
                'label' => 'besondere Kennzeichen',
            ],
        ]);

/*
        $this->add([
            'name' => 'castration-date',
            'type' => Element\Date::class,
            'options' => [
                'label' => 'Kastrationsdatum',
            ],
        ]);

        $this->add([
            'name' => 'first-vaccination',
            'type' => Element\Date::class,
            'options' => [
                'label' => 'erste Impfung',
            ],
        ]);

        $this->add([
            'name' => 'second-vaccination',
            'type' => Element\Date::class,
            'options' => [
                'label' => 'zweite Impfung',
            ],
        ]);

        $this->add([
            'name' => 'next-vaccination',
            'type' => Element\Date::class,
            'options' => [
                'label' => 'nächste Impfung',
            ],
        ]);

        $this->add([
            'name' => 'tattoo-left',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Tätowierung Li',
                'maxlength' => '5',
            ],
        ]);

        $this->add([
            'name' => 'tattoo-right',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Tätowierung Re',
                'maxlength' => '5',
            ],
        ]);

        $this->add([
            'name' => 'chip',
            'type' => Element\Number::class,
            'options' => [
                'label' => 'Chip (15 Zeichen)',
                'maxlength' => '15',
            ],
        ]);

        $this->add([
            'name' => 'comments',
            'type' => Element\Textarea::class,
            'options' => [
                'label' => 'Bemerkung',
            ],
        ]);

        $this->add([
            'type' => Element\Checkbox::class,
            'name' => 'deceased',
            'options' => [
                'label' => 'Ist verstorben?',
                'checked_value' => '1',
                'unchecked_value' => '0',
            ],
        ]);
        
        $this->add([
            'name' => 'cause-of-death',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Todesursache',
            ],
        ]);
        
        $this->add([
            'type' => Element\Checkbox::class,
            'name' => 'is-indoor-cat',
            'options' => [
                'label' => 'Ist eine Wohnungskatze?',
                'checked_value' => '1',
                'unchecked_value' => '0',
            ],
        ]);
        
        $this->add([
            'type' => Element\Checkbox::class,
            'name' => 'is-outdoor-cat',
            'options' => [
                'label' => 'Ist ein Freigänger?',
                'checked_value' => '1',
                'unchecked_value' => '0',
            ],
        ]);
        
        $this->add([
            'type' => Element\Checkbox::class,
            'name' => 'is-cat-friendly',
            'options' => [
                'label' => 'Ist katzenverträglich?',
                'checked_value' => '1',
                'unchecked_value' => '0',
            ],
        ]);
        
        $this->add([
            'type' => Element\Checkbox::class,
            'name' => 'is-dog-friendly',
            'options' => [
                'label' => 'Ist hundeveträglich?',
                'checked_value' => '1',
                'unchecked_value' => '0',
            ],
        ]);
        
        $this->add([
            'type' => Element\Checkbox::class,
            'name' => 'is-child-friendly',
            'options' => [
                'label' => 'Ist kinderverträglich?',
                'checked_value' => '1',
                'unchecked_value' => '0',
            ],
        ]);
*/
        
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'speichern',
            ],
        ]);

        // @TODO: File upload field for "image-path"
    }

}
