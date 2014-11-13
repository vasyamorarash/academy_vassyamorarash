<?php
Class FootballClubs{
	protected $id;
	protected $table_name;

	public function add_to_db($array){
		$keys = "";
		$values = "";
		foreach ($array as $key => $value) {
			$keys .= "$key,";
			$values .= "'$value',";
		}
		$keys = substr($keys, 0, strlen($keys)-1);
		$values = substr($values, 0, strlen($values)-1);
		$sql = "INSERT INTO $this->table_name ($keys) VALUES ($values);";
		return mysql_query($sql);
	}

	public function select_all_info($sort = '',$search = ''){
	
	}

	public function delete_from_db($id){
		$sql = "DELETE FROM $this->table_name WHERE id = $id";
		return mysql_query($sql);
	}

	public function select_all(){
		$sql = "SELECT * FROM $this->table_name;";
		$result_id = mysql_query($sql);
		while($row = mysql_fetch_assoc($result_id)){					
	 		$array[] = $row;
		}
		return $array;
	}
}
?>