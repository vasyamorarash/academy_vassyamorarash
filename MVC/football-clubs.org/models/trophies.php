<?php
Class Trophies extends FootballClubs{	
	private $name;
	private $year;
	public function __construct(){
		$this->table_name = "trophies";
	}
	public function delete_from_db($trophyId){
		$sql = "DELETE FROM `clubs_trophies` WHERE `clubs_trophies`.`trophy_id` = $trophyId";
			mysql_query($sql);
			$sql = "DELETE FROM `trophies` WHERE `trophies`.`id` = $trophyId";
			return mysql_query($sql);
	}

    public function select_all_info($sort = '',$search = ''){
        if ($sort !='') {
            $sql = "SELECT tr.`name`,tr.`year`
					FROM `trophies` AS tr
					WHERE tr.`name` LIKE '%$search%' ORDER BY $sort;";
        }
        else{
            $sql = "SELECT tr.`name`,tr.`year`
					FROM `trophies` AS tr
					WHERE tr.`name` LIKE '%$search%';";
        }
        $result_id = mysql_query($sql);
        while($row = mysql_fetch_row($result_id)){
            $array[] = $row;
        }
        return $array;
    }

    public function get_trophies_by_club($club_id){
        $sql = "SELECT tr.`name`
					FROM `trophies` AS tr
					INNER JOIN `clubs` AS c,`clubs_trophies` AS ct
					WHERE c.`id` = ct.`club_id`  AND ct.`trophy_id` = tr.`id`
					AND c.`id` = $club_id";
        $result_id = mysql_query($sql);
        while($row = mysql_fetch_row($result_id)){
            $array[] = $row;
        }
        return $array;
    }
}
?>