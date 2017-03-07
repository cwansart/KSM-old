<?php
namespace Animal;

use Zend\Router\Http\Literal;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'animal' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/animal',
                    'defaults' => [
                        'controller'    => Controller\AnimalController::class,
                        'action'        => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\AnimalController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'animal' => __DIR__ . '/../view',
        ],
    ],
];
