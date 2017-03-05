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
        $serviceManager = $ev->getApplication()->getServiceManager();
        $sessionController = $serviceManager->get(Controller\SessionController::class);
        $sessionController->setRequest($ev->getRequest());

        if (!$sessionController->check()) {
            if (!in_array($ev->getRequest()->getRequestUri(),
                            $this->getConfig()['whitelist_routes'])) {
                header('Location: /login');
                exit;
            }
        }

        /*

          $row = $this->getSession($serviceManager, 1, $sessionManager->getId());
          $request = $serviceManager->get('Request');
          die(var_dump($request));
          if (isset($container->init) &&
          $container->remoteAddr === $request->getServer('REMOTE_ADDR') &&
          $container->httpUserAgent === $request->getServer('HTTP_USER_AGENT') &&
          $row !== false) {
          if (in_array($request->getRequestUri(),
          $this->getConfig()['whitelist_routes'])) {
          die('NOPE EINLOGGEN!');
          } else {
          return;
          }
          }

          $this->saveSession($serviceManager, $sessionManager, $request, 1);

         */
    }

    private function getSession($serviceManager, $userId, $sessionId)
    {
        $adapter = $serviceManager->get(\Zend\Db\Adapter\Adapter::class);

        $sql = new \Zend\Db\Sql\Sql($adapter);
        $select = $sql->select();
        $select->from('sessions');
        $select->where(['user_id' => $userId, 'session_id' => $sessionId]);
        $selectString = $sql->buildSqlString($select);

        $statement = $adapter->query($selectString);
        $result = $statement->execute();
        $row = $result->current();
        if ($row !== false) {
            $result->getResource()->close();
        }

        return $row;
    }

    private function saveSession($serviceManager, $sessionManager, $request,
            $userId)
    {
        $sessionManager->regenerateId(true);
        $container->init = 1;
        $container->user_id = 1;
        $container->remoteAddr = $request->getServer('REMOTE_ADDR');
        $container->httpUserAgent = $request->getServer('HTTP_USER_AGENT');

        $adapter = $serviceManager->get(\Zend\Db\Adapter\Adapter::class);
        $sql = new \Zend\Db\Sql\Sql($adapter);
        $insert = $sql->insert('sessions');
        $insert->columns(['user_id', 'session_id']);
        $insert->values([$userId, $sessionManager->getId()]);
        $insertString = $sql->buildSqlString($insert);
        $adapter->query($insertString)->execute();
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
