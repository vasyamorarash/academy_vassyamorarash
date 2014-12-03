<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->view->title = "Football Clubs";
        $this->view->headTitle("Main",'PREPEND');
        $searchClubsForm = new Application_Form_ClubsSearch();
        $this->view->searchClubsForm = $searchClubsForm;
        $searchTrophiesForm = new Application_Form_TrophiesSearch();
        $this->view->searchTrophiesForm = $searchTrophiesForm;


        if($this->getRequest()->getPost('searchClub')){
            if($searchClubsForm->isValid($this->getRequest()->getPost())){
                $club = new Application_Model_Club();
                $this->view->clubs = $club->getClubsByParam($searchClubsForm->getValues());
            }
        }

        if($this->getRequest()->getPost('search')){
            if($searchTrophiesForm->isValid($this->getRequest()->getPost())){
                $trophy = new Application_Model_Trophy();
                $this->view->trophies = $trophy->getTrophiesByClub($searchTrophiesForm->getValues());
            }
        }
    }


}

