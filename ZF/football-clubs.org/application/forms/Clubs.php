<?php

class Application_Form_Clubs extends Zend_Form{
    public function __construct(){
        $this->setName('form_clubs');
        parent::__construct();

        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Club name')
            ->setRequired(true)
            ->addValidator('NotEmpty');

        $town = new Application_Model_Town();
        $town = $town->getAll();
        foreach ($town as $t) {
            $arrtown[$t->id]=$t->name;

        }

        $town_id = new Zend_Form_Element_Select('town_id');
        $town_id->setLabel('Town')
            ->addMultiOptions($arrtown);

        $league = new Application_Model_League();
        $league = $league->getAll();
        foreach ($league as $l) {
            $arrleague[$l->id]=$l->name;

        }

        $leagues = new Zend_Form_Element_Multiselect('leagues[]');
        $leagues->setLabel('Leagues')
            ->addMultiOptions($arrleague);

        $year = new Zend_Form_Element_Text('year');
        $year->setLabel('Year')
            ->setRequired(true)
            ->addValidator('NotEmpty');

        $trophy = new Application_Model_Trophy();
        $trophy = $trophy->getAll();
        foreach ($trophy as $t) {
            $arrtrophy[$t->id]=$t->name;

        }

        $trophies = new Zend_Form_Element_Multiselect('trophies[]');
        $trophies->setLabel('Trophies')
            ->addMultiOptions($arrtrophy);

        $count_trophies = new Zend_Form_Element_Text('count_trophies');
        $count_trophies->setLabel('Count Trophies')
            ->setRequired(true)
            ->addValidator('NotEmpty');

        $annual_budget = new Zend_Form_Element_Text('annual_budget');
        $annual_budget->setLabel('Annual Budget')
            ->setRequired(true)
            ->addValidator('NotEmpty');

        $president = new Application_Model_President();
        $president = $president->getAll();
        foreach ($president as $p) {
            $arrpresident[$p->id]=$p->name;

        }

        $president_id = new Zend_Form_Element_Select('president_id');
        $president_id->setLabel('President')
            ->addMultiOptions($arrpresident);

        $stadium = new Application_Model_Stadium();
        $stadium = $stadium->getAll();
        foreach ($stadium as $s) {
            $arrstadium[$s->id]=$s->name;

        }

        $stadium_id = new Zend_Form_Element_Select('stadium_id');
        $stadium_id->setLabel('Stadium')
            ->addMultiOptions($arrstadium);

        $submit = new Zend_Form_Element_submit('addclub');
        $submit->setLabel('Add club');


        $this->addElements(array($name, $town_id, $leagues, $year, $trophies, $count_trophies, $annual_budget, $president_id, $stadium_id, $submit));
    }
}