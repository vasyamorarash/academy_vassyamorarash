<?php
/**
 * Created by PhpStorm.
 * User: Vassya
 * Date: 30.11.2014
 * Time: 21:50
 */
class Application_Model_League{
    protected $_dbTable;
    protected $_row;

    public function __construct($id = null){
        $this->_dbTable = new Application_Model_DbTable_Leagues();
        if ($id){
            $this->_row = $this->_dbTable->find($id)->current();
        }else{
            $this->_row = $this->_dbTable->createRow();
        }
    }

    public function getAll(){
        return $this->_dbTable->fetchAll();
    }

    public function getAllLeaguesInfo($search = '',$sort='leagues.name'){
        $select = $this->_dbTable->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
            ->setIntegrityCheck(false)
            ->from('',array('league_id' => 'leagues.id','league_name' => 'leagues.name','country_name' => 'countries.name',
                'president_name' => 'presidents.name'))
            ->join('countries', 'countries.id = leagues.country_id')
            ->join('presidents', 'presidents.id = leagues.president_id')
            ->order($sort)
            ->where('leagues.name LIKE ?','%' . $search . '%');
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

    public function deleteLeague($data){
        $where = $this->_dbTable->getAdapter()->quoteInto('id = ?', $data['league_id']);
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