<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Animal\Controller;

use RuntimeException;
use Animal\Form\AnimalForm;
use Animal\Form\AnimalDeleteForm;
use Animal\Model\Animal;
use Animal\Model\AnimalTable;
use Zend\Mvc\Controller\AbstractActionController;

class AnimalController extends AbstractActionController
{
    private $table;
    
    public function __construct(AnimalTable $table) {
        $this->table = $table;
    }
    
    public function indexAction()
    {
        $animals = $this->table->fetchAll();
        return ['animals' => $animals];
    }
    
    public function showAction()
    {
        $id = $this->params()->fromRoute('id');
        
        try {
            $animal = $this->table->getAnimal($id);
        } catch (\Animal\Model\ModelNotFoundException $ex) {
            $this->response->setStatusCode(404);
            return;
        }
        
        return ['animal' => $animal];
    }

    public function addAction()
    {
        $form = new AnimalForm();
        $form->get('submit')->setValue('speichern');
        
        if (!$this->request->isPost()) {
            return ['form' => $form];
        }
        
        $animal = new Animal();
        $form->setInputFilter($animal->getInputFilter());
        $form->setData($this->request->getPost());
        if (!$form->isValid()) {
            return ['form' => $form];
        }
        
        $formData = $form->getData();
        $animal->exchangeArray($formData);
        $id = $this->table->saveAnimal($animal);
        return $this->redirect()->toRoute('animal', ['id' => $id]);
    }

    public function editAction()
    {
        $id = $this->params()->fromRoute('id');

        try {
            $animal = $this->table->getAnimal($id);
        } catch (\Animal\Model\ModelNotFoundException $ex) {
            $this->response->setStatusCode(404);
            return;
        }

        $form = new AnimalForm();
        $form->get('submit')->setValue('speichern');
        if (!$this->request->isPost()) {
            $form->bind($animal);
            return ['form' => $form, 'id' => $id];
        }
        
        $form->setInputFilter($animal->getInputFilter());
        $form->setData($this->request->getPost());
        if (!$form->isValid()) {
            $form->bind($animal);
            return ['form' => $form, 'id' => $id];
        }
        
        $formData = $form->getData();
        $formData['id'] = $id;
        $animal->exchangeArray($formData);
        $this->table->saveAnimal($animal);
        return $this->redirect()->toRoute('animal/show', ['id' => $id]);
    }

    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');
        
        $form = new AnimalDeleteForm();
        if (!$this->request->isPost()) {
            try {
                $animal = $this->table->getAnimal($id);
            } catch (\Animal\Model\ModelNotFoundException $ex) {
                $this->response->setStatusCode(404);
                return;
            }
            return ['form' => $form, 'animal' => $animal];
        }

        
        $this->table->deleteAnimal($id);
        return $this->redirect()->toRoute('animal');
    }
}
