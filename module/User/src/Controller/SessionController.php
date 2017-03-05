<?php
namespace User\Controller;

use User\Model\UserTable;
use User\Model\SessionTable;
use Zend\Session\Container;
use Zend\Session\SessionManager;
use Zend\Mvc\Controller\AbstractActionController;

class SessionController extends AbstractActionController
{
    private $table;
    private $userTable;
    private $manager;
    private $container;

    public function __construct(SessionTable $table, UserTable $userTable,
            SessionManager $manager, Container $container)
    {
        $this->table = $table;
        $this->userTable = $userTable;
        $this->manager = $manager;
        $this->container = $container;
    }

    public function setRequest($request)
    {
        $this->request = $request;
    }

    public function check()
    {
        $userId = $this->container->user_id;
        if ($userId !== NULL && is_numeric($userId)) {
            $session = $this->table->getSession($userId, $this->manager->getId());
            if ($session === false || $session === NULL) {
                return false;
            }
            return true;
        }

        return false;
    }

    public function loginAction()
    {
        $form = new \User\Form\SessionLoginForm();
        $form->get('submit')->setValue('speichern');

        if (!$this->request->isPost()) {
            return ['form' => $form];
        }

        $inputAddFilter = \User\Model\User::getAddInputFilder();
        $form->setInputFilter($inputAddFilter);
        $form->setData($this->request->getPost());

        if (!$form->isValid()) {
            return ['form' => $form];
        }

        $formData = $form->getData();
        try {
            $user = $this->userTable->getUserByName($formData['name']);
            if (password_verify($formData['password'], trim($user->password))) {
                $this->saveSession($user->id);
            }
            return $this->redirect()->toRoute('home');
        } catch (\RuntimeException $e) {
            return ['form' => $form, 'incorrectCredentials' => true];
        }
    }

    private function saveSession(int $userId)
    {
        $this->manager->regenerateId(true);
        $this->container->user_id = $userId;
        $this->container->remoteAddr = $this->getRequest()->getServer('REMOTE_ADDR');
        $this->container->httpUserAgent = $this->getRequest()->getServer('HTTP_USER_AGENT');
        
        $session = new \User\Model\Session();
        $session->userId = $userId;
        $session->sessionId = $this->manager->getId();
        $this->table->saveSession($session);
    }

}
