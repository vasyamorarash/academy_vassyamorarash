<?php
/**
 * Created by PhpStorm.
 * User: Vassya
 * Date: 29.11.2014
 * Time: 21:28
 */
class Application_Model_Club{
    protected $_dbTable;
    protected $_row;

    public function __construct($id = null){
        $this->_dbTable = new Application_Model_DbTable_Clubs();
        if ($id){
            $this->_row = $this->_dbTable->find($id)->current();
        }else{
            $this->_row = $this->_dbTable->createRow();
        }
    }

    public function getAll(){
        return $this->_dbTable->fetchAll();
    }

    public function getAllClubsInfo($search = '',$sort='clubs.name'){
        $select = $this->_dbTable->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
            ->setIntegrityCheck(false)
            ->from('',array('club_id' => 'clubs.id','club_name' => 'clubs.name','club_year' => 'clubs.year',
                'town_name' => 'towns.name','country_name' => 'countries.name',
                'president_name' => 'presidents.name','stadium_name' => 'stadiums.name'))
            ->join('towns', 'towns.id = clubs.town_id')
            ->join('countries', 'countries.id = towns.country_id')
            ->join('presidents', 'presidents.id = clubs.president_id')
            ->join('stadiums', 'stadiums.id = clubs.stadium_id')
            ->order($sort)
            ->where('clubs.name LIKE ?','%' . $search . '%');
        //die($select);
        return $this->_dbTable->fetchAll($select);
    }

    public function getCountOfTrophies($id){
        $select = $this->_dbTable->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
            ->setIntegrityCheck(false)
            ->from('',array('sc' => 'SUM(count)'))
            ->join('clubs_trophies', 'clubs.id = clubs_trophies.club_id')
            ->join('trophies', 'trophies.id = clubs_trophies.trophy_id')
            ->where('clubs_trophies.club_id =' . $id);
        $count = $this->_dbTable->fetchRow($select);
        return $count->sc;
    }

    public function getLeaguesById($id){
        $select = $this->_dbTable->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
            ->setIntegrityCheck(false)
            ->join('clubs_leagues', 'clubs.id = clubs_leagues.club_id')
            ->join('leagues', 'leagues.id = clubs_leagues.league_id')
            ->where('clubs_leagues.club_id =' . $id);
        $arrLeagues = $this->_dbTable->fetchAll($select);
        $leagues = '';
        foreach ($arrLeagues as $l) {
            $leagues .= $l->name . ';<br/>';
        }
        return $leagues;

    }

    public function getClubsByParam($data){
        $select = $this->_dbTable->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
            ->setIntegrityCheck(false)
            ->from('',array('club_id' => 'clubs.id','club_name' => 'clubs.name'))
            ->join('clubs_leagues', 'clubs.id = clubs_leagues.club_id')
            ->join('clubs_trophies', 'clubs.id = clubs_trophies.club_id')
            ->where('clubs_leagues.league_id =' . $data['league_id'])
            ->where('clubs_trophies.trophy_id =' . $data['trophy_id'])
            ->where('clubs.stadium_id =' . $data['stadium_id']);
        return $this->_dbTable->fetchAll($select);

    }



    public function deleteClub($data){
        $where = $this->_dbTable->getAdapter()->quoteInto('id = ?', $data['club_name']);
        $this->_dbTable->delete($where);
    }

    public function fill($data){
        foreach($data as $key => $value) {
            if (isset($this->_row->$key)) {
                $this->_row->$key = $value;
            }
        }
    }

    public function save(){
        return $this->_row->save();
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