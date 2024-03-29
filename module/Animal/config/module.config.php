<?php
namespace Animal;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\ServiceManager;

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
                'may_terminate' => true,
                'child_routes' => [
                    'add' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/add',
                            'defaults' => [
                                'action' => 'add'
                            ],
                        ],
                    ],
                    'show' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/:id',
                            'constraints' => [
                                'id'     => '[1-9]\d*',
                            ],
                            'defaults' => [
                                'action' => 'show',
                            ],
                        ],
                    ],
                    'edit' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/edit/:id',
                            'constraints' => [
                                'id'     => '[1-9]\d*',
                            ],
                            'defaults' => [
                                'action' => 'edit',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\AnimalController::class => function(ServiceManager $serviceManager) {
                return new Controller\AnimalController($serviceManager->get(Model\AnimalTable::class));
            },
        ],
    ],
    'service_manager' => [
        'factories' => [
            Model\AnimalTable::class => function($serviceManager) {
                return new Model\AnimalTable($serviceManager->get(Model\AnimalTableGateway::class));
            },
            Model\AnimalTableGateway::class => function($serviceManager) {
                $adapter = $serviceManager->get(AdapterInterface::class);
                $animalPrototype = new ResultSet();
                $animalPrototype->setArrayObjectPrototype(new Model\Animal);
                return new TableGateway('animals', $adapter, null, $animalPrototype);
            },
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'animal' => __DIR__ . '/../view',
        ],
    ],
];
