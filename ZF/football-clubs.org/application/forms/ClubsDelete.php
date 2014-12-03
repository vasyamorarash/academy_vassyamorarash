<?php
/**
 * Created by PhpStorm.
 * User: Vassya
 * Date: 29.11.2014
 * Time: 19:38
 */
class Application_Form_ClubsDelete extends Zend_Form
{
    public function __construct()
    {
        $this->setName('form_clubs_delete');
        parent::__construct();

        $club = new Application_Model_Club();
        $objclubs = $club->getAll();
        foreach ($objclubs as $c) {
            $arrclub[$c->id]=$c->name;

        }
        $club_id = new Zend_Form_Element_Select('club_name');
        $club_id->setLabel('Club')
            ->addMultiOptions($arrclub);

        $submit = new Zend_Form_Element_submit('deleteclub');
        $submit->setLabel('Delete club');


        $this->addElements(array($club_id, $submit));
    }
}
?>