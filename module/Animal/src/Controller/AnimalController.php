<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Animal\Controller;

use RuntimeException;
use Animal\Model\Animal;
use Animal\Form\AnimalForm;
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
        return [];
    }
    
    public function showAction()
    {
        $id = $this->params()->fromRoute('id');
        
        try {
            $animal = $this->table->getAnimal($id);
        } catch (RuntimeException $ex) {
            return $this->redirect()->toRoute('animal');
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
}
