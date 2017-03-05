<?php
namespace User;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Router\Http\Segment;
use Zend\Router\Http\Literal;
use Zend\ServiceManager\ServiceManager;
use Zend\Session\SessionManager;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'user' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/user[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\UserController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'login' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/login',
                    'defaults' => [
                        'controller' => Controller\SessionController::class,
                        'action' => 'login',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\UserController::class => function(ServiceManager $serviceManager) {
                return new Controller\UserController($serviceManager->get(Model\UserTable::class));
            },
            Controller\SessionController::class => function($serviceManager) {
                return $serviceManager->get(Controller\SessionController::class);
            },
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
            Model\SessionTable::class => function($serviceManager) {
                return new Model\SessionTable($serviceManager->get(Model\SessionTableGateway::class));
            },
            Model\SessionTableGateway::class => function($serviceManager) {
                $adapter = $serviceManager->get(AdapterInterface::class);
                $sessionPrototype = new ResultSet();
                $sessionPrototype->setArrayObjectPrototype(new Model\Session);
                return new TableGateway('sessions', $adapter, null,
                        $sessionPrototype);
            },
            Controller\SessionController::class => function(ServiceManager $serviceManager) {
                $sessionManager = new SessionManager();
                $sessionManager->start();
                $sessionContainer = new \Zend\Session\Container('ksm_session');

                return new Controller\SessionController($serviceManager->get(Model\SessionTable::class),
                        $serviceManager->get(Model\UserTable::class),
                        $sessionManager, $sessionContainer);
            },
        ],
    ],
    'whitelist_routes' => [
        '/login',
    ],
];
