<?php
Class Countries extends FootballClubs{	
	private $name;
	private $population;
	public function __construct(){
		$this->table_name = "countries";
	}	
}
?>