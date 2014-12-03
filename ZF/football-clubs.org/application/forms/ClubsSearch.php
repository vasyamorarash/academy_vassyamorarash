<?php
/**
 * Created by PhpStorm.
 * User: Vassya
 * Date: 03.12.2014
 * Time: 23:30
 */
class Application_Form_ClubsSearch extends Zend_Form
{
    public function __construct()
    {
        $this->setName('form_clubs_search');
        parent::__construct();

        $league = new Application_Model_League();
        $league = $league->getAll();
        foreach ($league as $l) {
            $arrLeague[$l->id]=$l->name;

        }
        $league_id = new Zend_Form_Element_Select('league_id');
        $league_id->setLabel('League')
            ->addMultiOptions($arrLeague);

        $trophy = new Application_Model_Trophy();
        $trophy = $trophy->getAll();
        foreach ($trophy as $t) {
            $arrTrophy[$t->id]=$t->name;

        }
        $trophy_id = new Zend_Form_Element_Select('trophy_id');
        $trophy_id->setLabel('Trophy')
            ->addMultiOptions($arrTrophy);

        $stadium = new Application_Model_Stadium();
        $stadium = $stadium->getAll();
        foreach ($stadium as $s) {
            $arrStadium[$s->id]=$s->name;

        }
        $stadium_id = new Zend_Form_Element_Select('stadium_id');
        $stadium_id->setLabel('Stadium')
            ->addMultiOptions($arrStadium);

        $submit = new Zend_Form_Element_submit('searchClub');
        $submit->setLabel('Search Clubs');


        $this->addElements(array($league_id, $trophy_id, $stadium_id, $submit));
    }
}