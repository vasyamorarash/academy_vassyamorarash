<?php
/**
 * Created by PhpStorm.
 * User: Vassya
 * Date: 29.11.2014
 * Time: 20:15
 */
class StadiumsController extends Zend_Controller_Action{
    public function indexAction(){
        $this->view->title = "Stadiums";
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

        $stadiums = new Application_Model_Stadium();
        $this->view->stadiums = $stadiums->getAll($search);
    }

    public function addAction(){
        $this->view->title = "Add Stadiums";
        $this->view->headTitle($this->view->title,'PREPEND');

        $form = new Application_Form_Stadiums();

        if($this->getRequest()->isPost()){
            if($form->isValid($this->getRequest()->getPost())){
                $stadium = new Application_Model_Stadium();
                $stadium->fill($form->getValues());
                $this->_helper->redirector('index');
            }
        }
        $this->view->form = $form;
    }

    public function deleteAction(){
        $this->view->title = "Delete Stadiums";
        $this->view->headTitle($this->view->title,'PREPEND');

        $form = new Application_Form_StadiumsDelete();

        if($this->getRequest()->isPost()){
            if($form->isValid($this->getRequest()->getPost())){
                $stadium = new Application_Model_Stadium();
                $stadium->deleteStadium($form->getValues());
                $this->_helper->redirector('index');
            }
        }
        $this->view->form = $form;
    }
}
?>