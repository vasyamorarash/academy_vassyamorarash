<?php
/**
 * Created by PhpStorm.
 * User: Vassya
 * Date: 29.11.2014
 * Time: 21:04
 */
class TrophiesController extends Zend_Controller_Action{
    public function indexAction(){
        $this->view->title = "Trophies";
        $this->view->headTitle($this->view->title,'PREPEND');

        $formSearch = new Application_Form_Search();
        $search = '';

        if($this->getRequest()->isPost()) {
            if ($formSearch->isValid($this->getRequest()->getPost())) {
                $arr = $formSearch->getValues();
                $search =  $arr['search'];
            }
        }
        $this->view->formSearch = $formSearch;

        $trophies = new Application_Model_Trophy();
        $this->view->trophy = $trophies->getAll($search);
    }

    public function addAction(){
        $this->view->title = "Add Trophies";
        $this->view->headTitle($this->view->title,'PREPEND');

        $form = new Application_Form_Trophies();

        if($this->getRequest()->isPost()){
            if($form->isValid($this->getRequest()->getPost())){
                $trophy = new Application_Model_Trophy();
                $trophy->fill($form->getValues());
                $this->_helper->redirector('index');
            }
        }
        $this->view->form = $form;
    }

    public function deleteAction(){
        $this->view->title = "Delete Trophies";
        $this->view->headTitle($this->view->title,'PREPEND');

        $form = new Application_Form_TrophiesDelete();

        if($this->getRequest()->isPost()){
            if($form->isValid($this->getRequest()->getPost())){
                $trophy = new Application_Model_Trophy();
                $trophy->deleteTrophy($form->getValues());
                $this->_helper->redirector('index');
            }
        }
        $this->view->form = $form;
    }
}
?>