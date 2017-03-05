<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace User\Controller;

use User\Form\UserAddForm;
use User\Form\UserEditForm;
use User\Model\User;
use User\Model\UserTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    private $table;

    public function __construct(UserTable $table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {
        return new ViewModel(['users' => $this->table->fetchAll()]);
    }

    public function addAction()
    {
        $form = new UserAddForm();
        $form->get('submit')->setValue('speichern');

        if (!$this->request->isPost()) {
            return ['form' => $form];
        }

        $user = new User();
        $form->setInputFilter($user->getAddInputFilter());
        $form->setData($this->request->getPost());

        if (!$form->isValid()) {
            return ['form' => $form];
        }

        // Hash password
        $formData = $form->getData();
        $formData['password'] = password_hash($formData['password'],
                PASSWORD_DEFAULT);

        $user->exchangeArray($formData);
        $this->table->saveUser($user);
        return $this->redirect()->toRoute('user');
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id < 1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        try {
            $user = $this->table->getUser($id);
        } catch (Exception $ex) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $form = new UserEditForm();
        $form->bind($user);
        $form->get('submit')->setAttribute('value', 'speichern');

        $viewData = [
            'id' => $id,
            'form' => $form
        ];

        if (!$this->getRequest()->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($user->getEditInputFilter());
        $form->setData($this->getRequest()->getPost());
        if (!$form->isValid()) {
            return $viewData;
        }

        $user->id = $id;
        $this->table->saveUser($user);
        return $this->redirect()->toRoute('user');
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id < 2) { // don't delete "root"
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        if($this->getRequest()->isPost()) {
            if($this->getRequest()->getPost('del', 'nein') == 'ja') {
                $this->table->deleteUser($id);
            }
            
            return $this->redirect()->toRoute('user');
        }
        
        return [
            'id' => $id,
            'user' => $this->table->getUser($id),
        ];
    }

}
