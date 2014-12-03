<?php
/**
 * Created by PhpStorm.
 * User: Vassya
 * Date: 29.11.2014
 * Time: 21:06
 */
class Application_Form_Trophies extends Zend_Form{
    public function __construct(){
        $this->setName('form_trophies');
        parent::__construct();

        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Trophy name')
            ->setRequired(true)
            ->addValidator('NotEmpty');

        $year = new Zend_Form_Element_Text('year');
        $year->setLabel('Year')
            ->setRequired(true)
            ->addValidator('NotEmpty');




        $submit = new Zend_Form_Element_submit('addtrophy');
        $submit->setLabel('Add Trophy');


        $this->addElements(array($name, $year, $submit));
    }
}