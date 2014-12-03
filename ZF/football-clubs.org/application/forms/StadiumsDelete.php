<?php
/**
 * Created by PhpStorm.
 * User: Vassya
 * Date: 29.11.2014
 * Time: 20:43
 */
class Application_Form_StadiumsDelete extends Zend_Form
{
    public function __construct()
    {
        $this->setName('form_stadiums_delete');
        parent::__construct();

        $stadium = new Application_Model_Stadium();
        $stadium = $stadium->getAll();
        foreach ($stadium as $s) {
            $arrstadium[$s->id]=$s->name;

        }
        $stadium_id = new Zend_Form_Element_Select('stadium_id');
        $stadium_id->setLabel('Stadium')
            ->addMultiOptions($arrstadium);

        $submit = new Zend_Form_Element_submit('deletestadium');
        $submit->setLabel('Delete Stadium');


        $this->addElements(array($stadium_id, $submit));
    }
}
?>