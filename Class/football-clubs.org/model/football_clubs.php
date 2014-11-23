<?php
Class FootballClubs{
	protected $id;
	protected $table_name;

	public function insert($array){
		$sql = "INSERT INTO $this->table_name (";
			$values = ") VALUES (";
		foreach ($array as $key => $value) {
			$sql .= "$key,";
			$values .= "'$value',";
		}
		$sql = substr($sql, 0, strlen($sql)-1);
		$values = substr($values, 0, strlen($values)-1);
		$sql .= $values;
		$sql .= ");";
		return mysql_query($sql);
	}

	public function delete($id){
		$sql = "DELETE FROM $this->table_name WHERE id = $id";
		return mysql_query($sql);
	}

	public function select($sql){
		$result_id = mysql_query($sql);
		while($row = mysql_fetch_row($result_id)){					
	 		$array[] = $row;
		}
		return $array;
	}
}
?>