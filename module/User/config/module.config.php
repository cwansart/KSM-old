<?php
namespace User;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\ServiceManager;

return [
    'router' => [
        'routes' => [
            'user' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/user[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\UserController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\UserController::class => function(ServiceManager $serviceManager) {
                return new Controller\UserController($serviceManager->get(Model\UserTable::class));
            }
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'user' => __DIR__ . '/../view',
        ],
    ],
    'service_manager' => [
        'factories' => [
            Adapter::class => AdapterServiceFactory::class,
            Model\UserTable::class => function($serviceManager) {
                return new Model\UserTable($serviceManager->get(Model\UserTableGateway::class));
            },
            Model\UserTableGateway::class => function($serviceManager) {
                $adapter = $serviceManager->get(AdapterInterface::class);
                $userPrototype = new ResultSet();
                $userPrototype->setArrayObjectPrototype(new Model\User);
                return new TableGateway('users', $adapter, null, $userPrototype);
            },
        ],
    ],
];
