<form class="search" action="" method="POST">
		<p><input type="text" name="search" size="30">
		<input type="submit" name="Search" value="Search"></p>
</form>
<form class="sort" action="" method="POST">
		<select name="sort" size="1">
			<option value=""></option>
			<option value="l.`name`">Name</option>
			<option value="co.`name`">Counrty</option>
			<option value="l.`uefa_rating`">UEFA rating</option>
			<option value="p.`name`">President</option>
		</select>
		<input type="submit" name="sorded" value="Sort"></p>
</form>


<table>
	<tr>
		<th>
		League
		</th>
		<th>
		County
		</th>
		<th>
		UEFA rating
		</th>
		<th>
		President
		</th>
	</tr>
	<?php
		$search = $_POST['search'];
		$sort = $_POST['sort'];
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
		$arr_leagues = FootballClubs::select($sql);
		for ($i=0; $i < count($arr_leagues); $i++) {
			echo "<tr>";
			 	echo "<td>" . $arr_leagues[$i][0] . "</td>";
			 	echo "<td>" . $arr_leagues[$i][1] . "</td>";
				echo "<td>" . $arr_leagues[$i][2] . "</td>";
				echo "<td>" . $arr_leagues[$i][3] . "</td>";
			echo "</tr>";
		}
	?>
</table>