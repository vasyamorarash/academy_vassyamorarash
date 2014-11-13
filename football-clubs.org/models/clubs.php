<?php
Class Clubs extends FootballClubs{	
	private $name;
	private $town;
	private $town_id;
	private $country;
	private $country_id;
	private $leagues;
	private $year;
	private $trophy_count = 0;
	private $annual_budget;
	private $president;
	private $president_id;
	private $stadium;
	private $stadium_id;

	public function __construct(){
		$this->table_name = "clubs";
	}

	public function __get($var){
		return $this->$var;
	}

	public function __set($var,$value){
		$this->$var = $value;
	}

	public function select_all_info($sort = '',$search = ''){
		if ($sort != '') {
		$sql = "SELECT c.`id`,c.`name`,t.`name`,co.`name`,l.`name`,c.`year`,c.`annual_budget`,p.`name`,s.`name` 
					FROM `clubs` AS c
					INNER JOIN `towns` AS t,`countries` AS co,`presidents` AS p,`stadiums` 
                                        AS s,`clubs_leagues` AS cl,`leagues` AS l
        			WHERE c.`town_id` = t.`id` 
						AND t.`country_id` = co.`id`
       					AND c.`president_id` = p.`id`
        				AND c.`stadium_id` = s.`id`
        				AND c.`id` = cl.`club_id` 
						AND cl.`league_id` = l.`id` 
						AND c.`name` LIKE '%$search%' ORDER BY $sort;";
		}
		else{
			$sql = "SELECT c.`id`,c.`name`,t.`name`,co.`name`,l.`name`,c.`year`,c.`annual_budget`,p.`name`,s.`name` 
					FROM `clubs` AS c
					INNER JOIN `towns` AS t,`countries` AS co,`presidents` AS p,`stadiums` 
                                        AS s,`clubs_leagues` AS cl,`leagues` AS l
        			WHERE c.`town_id` = t.`id` 
						AND t.`country_id` = co.`id`
       					AND c.`president_id` = p.`id`
        				AND c.`stadium_id` = s.`id`
        				AND c.`id` = cl.`club_id` 
						AND cl.`league_id` = l.`id`
						AND c.`name` LIKE '%$search%';";
		}
		$result_id = mysql_query($sql);
		while($row = mysql_fetch_row($result_id)){					
	 		$array[] = $row;
		}
		return $array;
	}

	public function select_count_trophy(){
		$sql = "SELECT c.`id`,ct.`count` 
					FROM `clubs` AS c
					INNER JOIN `clubs_trophies` AS ct, `trophies` AS tr
        			WHERE c.`id` = ct.`club_id`
        			AND ct.`trophy_id` = tr.`id`;";
        $result_id = mysql_query($sql);
		while($row = mysql_fetch_row($result_id)){					
	 		$array[] = $row;
		}
		return $array;
	}

	public function delete_from_db($clubId){
		$sql = "DELETE FROM `clubs_trophies` WHERE `clubs_trophies`.`club_id` = $clubId";
		$result_id = mysql_query($sql);
		$sql = "DELETE FROM `clubs_leagues` WHERE `clubs_leagues`.`club_id` = $clubId";
		$result_id = mysql_query($sql);
		$sql = "DELETE FROM `clubs` WHERE `clubs`.`id` = $clubId";
		$result_id = mysql_query($sql);
	}

	public function get_last_id(){
		return mysql_insert_id();
	}

    public function get_club_by_parameters($league_id,$trophy_id,$stadium_id){
        $sql = "SELECT c.`name`
					FROM `clubs` AS c
					INNER JOIN `clubs_leagues` AS cl, `clubs_trophies` AS ct
					WHERE c.`id` = cl.`club_id` AND c.`id` = ct.`club_id`
					AND cl.`league_id` = $league_id AND ct.`trophy_id` = $trophy_id
					AND c.`stadium_id` = $stadium_id";
        $result_id = mysql_query($sql);
        while($row = mysql_fetch_row($result_id)){
            $array[] = $row;
        }
        return $array;
    }
}
?>