<?php
Class Presidents extends FootballClubs{	
	private $name;
	private $birthday;
	public function __construct(){
		$this->table_name = "presidents";
	}	
}
?>