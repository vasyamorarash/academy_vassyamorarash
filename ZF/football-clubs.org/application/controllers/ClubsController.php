<?php
    class ClubsController extends Zend_Controller_Action{
        public function indexAction(){
            $this->view->title = "Clubs";
            $this->view->headTitle($this->view->title,'PREPEND');
            $club = new Application_Model_Club();

            $this->view->club = $club;

            $formSearch = new Application_Form_Search();
            $search = '';
            if($this->getRequest()->isPost()) {
                if ($formSearch->isValid($this->getRequest()->getPost())) {
                    $arr = $formSearch->getValues();
                    $search =  $arr['search'];
                }
            }
            if($_GET['sort'] == ''){
                $this->view->clubs = $club->getAllClubsInfo($search);
            }else{
                $this->view->clubs = $club->getAllClubsInfo($search,$_GET['sort']);
            }
            //echo $_GET['sort'];
            //$this->view->clubs = $club->getAllClubsInfo($search);
            $this->view->formSearch = $formSearch;
        }

        public function addAction(){
            $this->view->title = "Add Clubs";
            $this->view->headTitle($this->view->title,'PREPEND');

            $form = new Application_Form_Clubs();

            if($this->getRequest()->isPost()){
                if($form->isValid($this->getRequest()->getPost())){
                    $club = new Application_Model_Club();
                    $club->fill($form->getValues());
                    $lastId = $club->save();
                    $cl = new Application_Model_ClubLeague();
                    $cl->fill($form->getValues(),$lastId);
                    $ct = new Application_Model_ClubTrophy();
                    $ct->fill($form->getValues(),$lastId);

                    $this->_helper->redirector('index');
                }
            }
            $this->view->form = $form;
        }

        public function deleteAction(){
            $this->view->title = "Delete Clubs";
            $this->view->headTitle($this->view->title,'PREPEND');

            $form = new Application_Form_ClubsDelete();

            if($this->getRequest()->isPost()){
                if($form->isValid($this->getRequest()->getPost())){
                    $club = new Application_Model_Club();
                    $club->deleteClub($form->getValues());
                    $this->_helper->redirector('index');
                }
            }
            $this->view->form = $form;
        }

        public function viewAction(){
            $this->view->title = "View Clubs";
            $this->view->headTitle($this->view->title,'PREPEND');
        }

        public function editAction(){
            $this->view->title = "Edit Clubs";
            $this->view->headTitle($this->view->title,'PREPEND');
        }
    }
?>