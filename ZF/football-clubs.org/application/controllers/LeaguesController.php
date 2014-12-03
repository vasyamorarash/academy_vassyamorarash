<?php
/**
 * Created by PhpStorm.
 * User: Vassya
 * Date: 29.11.2014
 * Time: 19:48
 */
    class LeaguesController extends Zend_Controller_Action{
        public function indexAction(){
            $this->view->title = "Leagues";
            $this->view->headTitle($this->view->title,'PREPEND');

            $formSearch = new Application_Form_Search();
            $search = '';

            if($this->getRequest()->isPost()) {
                if ($formSearch->isValid($this->getRequest()->getPost())) {
                    $arr = $formSearch->getValues();
                    $search =  $arr['search'];
                }
            }

            $leagues = new Application_Model_League();
            $this->view->leagues = $leagues->getAllLeaguesInfo($search);
            $this->view->formSearch = $formSearch;
        }

        public function addAction(){
            $this->view->title = "Add Leagues";
            $this->view->headTitle($this->view->title,'PREPEND');

            $form = new Application_Form_Leagues();

            if($this->getRequest()->isPost()){
                if($form->isValid($this->getRequest()->getPost())){
                    $league = new Application_Model_League();
                    $league->fill($form->getValues());
                    $this->_helper->redirector('index');
                }
            }
            $this->view->form = $form;
        }

        public function deleteAction(){
            $this->view->title = "Delete Leagues";
            $this->view->headTitle($this->view->title,'PREPEND');

            $form = new Application_Form_LeaguesDelete();

            if($this->getRequest()->isPost()){
                if($form->isValid($this->getRequest()->getPost())){
                    $league = new Application_Model_League();
                    $league->deleteLeague($form->getValues());
                    $this->_helper->redirector('index');
                }
            }
            $this->view->form = $form;
        }
    }
?>