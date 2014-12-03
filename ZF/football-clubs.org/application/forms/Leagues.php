<?php
/**
 * Created by PhpStorm.
 * User: Vassya
 * Date: 29.11.2014
 * Time: 19:50
 */

class Application_Form_Leagues extends Zend_Form{
    public function __construct(){
        $this->setName('form_leagues');
        parent::__construct();

        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('League name')
            ->setRequired(true)
            ->addValidator('NotEmpty');

        $country = new Application_Model_Country();
        $country = $country->getAll();
        foreach ($country as $c) {
            $arrCountry[$c->id]=$c->name;

        }

        $country_id = new Zend_Form_Element_Select('country_id');
        $country_id->setLabel('Country')
            ->addMultiOptions($arrCountry);

        $uefa_rating = new Zend_Form_Element_Text('uefa_rating');
        $uefa_rating->setLabel('UEFA Rating')
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

        $submit = new Zend_Form_Element_submit('addleague');
        $submit->setLabel('Add League');


        $this->addElements(array($name, $country_id, $uefa_rating, $president_id, $submit));
    }
}