<?php
/**
 * Created by PhpStorm.
 * User: Vassya
 * Date: 29.11.2014
 * Time: 21:11
 */
class Application_Form_TrophiesDelete extends Zend_Form
{
    public function __construct()
    {
        $this->setName('form_trophies_delete');
        parent::__construct();

        $trophy = new Application_Model_Trophy();
        $trophy = $trophy->getAll();
        foreach ($trophy as $t) {
            $arrtrophy[$t->id]=$t->name;

        }

        $trophy_id = new Zend_Form_Element_Select('trophy_id');
        $trophy_id->setLabel('Trophy')
            ->addMultiOptions($arrtrophy);

        $submit = new Zend_Form_Element_submit('deletetrophy');
        $submit->setLabel('Delete Trophy');


        $this->addElements(array($trophy_id, $submit));
    }
}
?>