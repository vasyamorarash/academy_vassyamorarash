<form class="search" action="" method="POST">
		<p><input type="text" name="search" size="30">
		<input type="submit" name="Search" value="Search"></p>
</form>
<form class="sort" action="" method="POST">
		<select name="sort" size="1">
			<option value=""></option>
			<option value="s.`name`">Name</option>
			<option value="s.`year`">Year</option>
			<option value="s.`capacity`">Capacity</option>
		</select>
		<input type="submit" name="sorded" value="Sort"></p>
</form>
<table>
	<tr>
		<th>
		Stadium
		</th>
		<th>
		Year
		</th>
		<th>
		Capacity
		</th>
	</tr>
	<?php
	$search = $_POST['search'];
	$sort = $_POST['sort'];
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
		$arr_stadiums = FootballClubs::select($sql);
		for ($i=0; $i < count($arr_stadiums); $i++) {
			echo "<tr>";
			 	echo "<td>" . $arr_stadiums[$i][0] . "</td>";
			 	echo "<td>" . $arr_stadiums[$i][1] . "</td>";
				echo "<td>" . $arr_stadiums[$i][2] . "</td>";
			echo "</tr>";
		}
	?>
</table>