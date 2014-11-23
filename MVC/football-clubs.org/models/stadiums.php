<?php
Class Stadiums extends FootballClubs{	
	private $name;
	private $year;
	private $capacity;
	public function __construct(){
		$this->table_name = "stadiums";
	}

    public function select_all_info($sort = '',$search = ''){
        if ($sort !='') {
            $sql = "SELECT s.`name`,s.`year`,s.`capacity`
					FROM `stadiums` AS s
					WHERE s.`name` LIKE '%$search%' ORDER BY $sort;";
        }
        else{
            $sql = "SELECT s.`name`,s.`year`,s.`capacity`
					FROM `stadiums` AS s
					WHERE s.`name` LIKE '%$search%'";
        }
        $result_id = mysql_query($sql);
        while($row = mysql_fetch_row($result_id)){
            $array[] = $row;
        }
        return $array;
    }
}
?>