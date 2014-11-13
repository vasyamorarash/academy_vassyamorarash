<?php
Class Leagues extends FootballClubs{	
	private $name;
	private $country_id;
	private $uefa_rating;
	private $president_id;
	public function __construct(){
		$this->table_name = "leagues";
	}
	public function delete_from_db($leagueId){
		$sql = "DELETE FROM `clubs_leagues` WHERE `clubs_leagues`.`league_id` = $leagueId";
		$result_id = mysql_query($sql);
		$sql = "DELETE FROM `leagues` WHERE `leagues`.`id` = $leagueId";
		$result_id = mysql_query($sql);
	}

	public function select_all_info($sort = '',$search = ''){
		if ($sort !='') {
			$sql = "SELECT l.`name`,co.`name`,l.`uefa_rating`,p.`name` 
					FROM `leagues` AS l
					INNER JOIN `countries` AS co,`presidents` AS p
        			WHERE l.`country_id` = co.`id`
       					AND l.`president_id` = p.`id`
       					AND l.`name` LIKE '%$search%' ORDER BY $sort;";
		}
		else{
			$sql = "SELECT l.`name`,co.`name`,l.`uefa_rating`,p.`name` 
					FROM `leagues` AS l
					INNER JOIN `countries` AS co,`presidents` AS p
        			WHERE l.`country_id` = co.`id`
       					AND l.`president_id` = p.`id`
       					AND l.`name` LIKE '%$search%';";
		}
		$result_id = mysql_query($sql);
		while($row = mysql_fetch_row($result_id)){					
	 		$array[] = $row;
		}
		return $array;
	}	
}
?>