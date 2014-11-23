<?php
Class Towns extends FootballClubs{	
	private $name;
	private $country_id;
	private $population;
	public function __construct(){
		$this->table_name = "towns";
	}	
}
?>