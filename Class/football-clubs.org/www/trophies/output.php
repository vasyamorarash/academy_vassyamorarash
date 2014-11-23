<form class="search" action="" method="POST">
		<p><input type="text" name="search" size="30">
		<input type="submit" name="Search" value="Search"></p>
</form>
<form class="sort" action="" method="POST">
		<select name="sort" size="1">
			<option value=""></option>
			<option value="tr.`name`">Name</option>
			<option value="tr.`year` ">Year</option>
		</select>
		<input type="submit" name="sorded" value="Sort"></p>
</form>
<table>
	<tr>
		<th>
		Trophies
		</th>
		<th>
		Year
		</th>
	</tr>
	<?php
	$search = $_POST['search'];
	$sort = $_POST['sort'];
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
		$arr_trophies = FootballClubs::select($sql);
		for ($i=0; $i < count($arr_trophies); $i++) {
			echo "<tr>";
			 	echo "<td>" . $arr_trophies[$i][0] . "</td>";
			 	echo "<td>" . $arr_trophies[$i][1] . "</td>";
			echo "</tr>";
		}
	?>
</table>