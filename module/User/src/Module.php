<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User;

use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $ev)
    {
        // @TODO: Auth code here
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    
    public function getServiceConfig()
    {
        return $this->getConfig()['service_manager'];
    }
}
