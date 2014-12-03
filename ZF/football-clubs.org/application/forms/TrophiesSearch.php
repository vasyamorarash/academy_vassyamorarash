<?php
/**
 * Created by PhpStorm.
 * User: Vassya
 * Date: 04.12.2014
 * Time: 0:04
 */
class Application_Form_TrophiesSearch extends Zend_Form
{
    public function __construct()
    {
        $this->setName('form_trophies_search');
        parent::__construct();

        $club = new Application_Model_Club();
        $objclubs = $club->getAll();
        foreach ($objclubs as $c) {
            $arrclub[$c->id]=$c->name;

        }
        $club_id = new Zend_Form_Element_Select('club_id');
        $club_id->setLabel('Club')
            ->addMultiOptions($arrclub);

        $submit = new Zend_Form_Element_submit('search');
        $submit->setLabel('Search Trophies');


        $this->addElements(array($club_id, $submit));
    }
}