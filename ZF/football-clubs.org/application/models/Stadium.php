<?php
/**
 * Created by PhpStorm.
 * User: Vassya
 * Date: 30.11.2014
 * Time: 21:35
 */
class Application_Model_Stadium{
    protected $_dbTable;
    protected $_row;

    public function __construct($id = null){
        $this->_dbTable = new Application_Model_DbTable_Stadiums();
        if ($id){
            $this->_row = $this->_dbTable->find($id)->current();
        }else{
            $this->_row = $this->_dbTable->createRow();
        }
    }

    public function getAll($search = ''){
        $select = $this->_dbTable->select()
            ->where('name LIKE ?','%' . $search . '%');
        return $this->_dbTable->fetchAll($select);
    }

    public function fill($data){
        foreach($data as $key => $value) {
            if (isset($this->_row->$key)) {
                $this->_row->$key = $value;
            }
        }
        $this->_row->save();
    }
    public function deleteStadium($data){
        $where = $this->_dbTable->getAdapter()->quoteInto('id = ?', $data['stadium_id']);
        $this->_dbTable->delete($where);
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