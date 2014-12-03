<?php
/**
 * Created by PhpStorm.
 * User: Vassya
 * Date: 30.11.2014
 * Time: 23:15
 */
class Application_Form_Search extends Zend_Form
{
    public function __construct()
    {
        $this->setName('form_search');
        parent::__construct();

        $search = new Zend_Form_Element_Text('search');
        $search->setLabel('Search');

        $submit = new Zend_Form_Element_submit('searchClub');
        $submit->setLabel('Search');


        $this->addElements(array($search, $submit));
    }
}