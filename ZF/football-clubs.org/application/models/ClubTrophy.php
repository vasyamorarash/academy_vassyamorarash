<?php
/**
 * Created by PhpStorm.
 * User: Vassya
 * Date: 30.11.2014
 * Time: 22:55
 */
class Application_Model_ClubTrophy{
    protected $_dbTable;
    protected $_row;

    public function __construct($id = null){
        $this->_dbTable = new Application_Model_DbTable_ClubsTrophies();
        if ($id){
            $this->_row = $this->_dbTable->find($id)->current();
        }else{
            $this->_row = $this->_dbTable->createRow();
        }
    }

    public function getAll(){
        return $this->_dbTable->fetchAll();
    }

    public function fill($data,$club_id){
        $trophiesCount = explode(" ", $data["count_trophies"], count($data['trophies']));
        for($i=0;$i<count($data['trophies']);$i++){
            $d = array(
                'club_id' => $club_id,
                'trophy_id' => $data["trophies"][$i],
                'count' => $trophiesCount[$i]
            );
            $this->_dbTable->insert($d);
        }
    }

    public function __set($name, $val){
        if(isset($this->_row->$name)){
            $this->_row->$name = $val;
        }
    }

    public function __get($name){
        if(isset($this->_row->$name)){
            return $this->_row->$name;
        }
    }
}