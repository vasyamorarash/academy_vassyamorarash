<?php
/**
 * Created by PhpStorm.
 * User: Vassya
 * Date: 29.11.2014
 * Time: 20:16
 */
class Application_Form_Stadiums extends Zend_Form{
    public function __construct(){
        $this->setName('form_stadiums');
        parent::__construct();

        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Stadium name')
            ->setRequired(true)
            ->addValidator('NotEmpty');

        $year = new Zend_Form_Element_Text('year');
        $year->setLabel('Year')
            ->setRequired(true)
            ->addValidator('NotEmpty');

        $capacity = new Zend_Form_Element_Text('capacity');
        $capacity->setLabel('Capacity')
            ->setRequired(true)
            ->addValidator('NotEmpty');



        $submit = new Zend_Form_Element_submit('addstadium');
        $submit->setLabel('Add Stadium');


        $this->addElements(array($name, $year, $capacity, $submit));
    }
}