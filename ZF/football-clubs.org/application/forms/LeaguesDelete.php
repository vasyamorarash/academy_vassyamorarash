<?php
/**
 * Created by PhpStorm.
 * User: Vassya
 * Date: 29.11.2014
 * Time: 19:57
 */
class Application_Form_LeaguesDelete extends Zend_Form
{
    public function __construct()
    {
        $this->setName('form_leagues_delete');
        parent::__construct();

        $league = new Application_Model_League();
        $league = $league->getAll();
        foreach ($league as $l) {
            $arrleague[$l->id]=$l->name;

        }

        $leagues = new Zend_Form_Element_Select('league_id');
        $leagues->setLabel('League')
            ->addMultiOptions($arrleague);

        $submit = new Zend_Form_Element_submit('deleteleague');
        $submit->setLabel('Delete League');


        $this->addElements(array($leagues, $submit));
    }
}
?>