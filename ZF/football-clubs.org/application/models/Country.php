<?php
/**
 * Created by PhpStorm.
 * User: Vassya
 * Date: 03.12.2014
 * Time: 17:18
 */
class Application_Model_Country{
    protected $_dbTable;
    protected $_row;

    public function __construct($id = null){
        $this->_dbTable = new Application_Model_DbTable_Countries();
        if ($id){
            $this->_row = $this->_dbTable->find($id)->current();
        }else{
            $this->_row = $this->_dbTable->createRow();
        }
    }

    public function getAll(){
        return $this->_dbTable->fetchAll();
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