<form class="search" action="" method="POST">
		<p><input type="text" name="search" size="30">
		<input type="submit" name="Search" value="Search"></p>
</form>
<form class="sort" action="" method="POST">
		<select name="sort" size="1">
			<option value=""></option>
			<option value="c.`name`">Name</option>
			<option value="t.`name`">Town</option>
			<option value="co.`name`">Counrty</option>
			<option value="c.`year`">Year</option>
			<option value="c.`annual_budget`">Annual budget</option>
			<option value="p.`name`">President</option>
			<option value="s.`name`">Home stadium</option>
		</select>
		<input type="submit" name="sorded" value="Sort"></p>
</form>
<table>
	<tr>
		<th>
		Club
		</th>
		<th>
		Town
		</th>
		<th>
		County
		</th>
		<th>
		Leagues
		</th>
		<th>
		Year
		</th>
		<th>
		Count of trophies
		</th>
		<th>
		Annual budget
		</th>
		<th>
		President
		</th>
		<th>
		Home stadium
		</th>
	</tr>
	<?php
		mb_internal_encoding ( "UTF-8" );

		$clubs[] = new Clubs();
		$league = new Leagues();
		$trophy = new Trophies();

		$sort = $_POST['sort'];

		if ($_POST['sort'] != '') {
		$sql = "SELECT c.`id`,c.`name`,t.`name`,co.`name`,l.`name`,c.`year`,c.`annual_budget`,p.`name`,s.`name` 
					FROM `clubs` AS c
					INNER JOIN `towns` AS t,`countries` AS co,`presidents` AS p,`stadiums` 
                                        AS s,`clubs_leagues` AS cl,`leagues` AS l
        			WHERE c.`town_id` = t.`id` 
						AND t.`country_id` = co.`id`
       					AND c.`president_id` = p.`id`
        				AND c.`stadium_id` = s.`id`
        				AND c.`id` = cl.`club_id` 
						AND cl.`league_id` = l.`id` ORDER BY $sort;";
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
						AND cl.`league_id` = l.`id`";
		}
		$arr_clubs = FootballClubs::select($sql);
		$club_count = 0;
		for ($i=0; $i < count($arr_clubs); $i++) { 
			$flag = true;
			for($j=0;(($j<$club_count) && ($flag));$j++){
				if ($clubs[$j]->id==$arr_clubs[$i][0]) {
					$flag = false;
					$index = $j;
				}					
			}
			if($flag == true){
				$clubs[$club_count]->id = $arr_clubs[$i][0];
				$clubs[$club_count]->name = $arr_clubs[$i][1];
				$clubs[$club_count]->town = $arr_clubs[$i][2];
				$clubs[$club_count]->country = $arr_clubs[$i][3];
				$clubs[$club_count]->leagues = $arr_clubs[$i][4];
				$clubs[$club_count]->year = $arr_clubs[$i][5];
				$clubs[$club_count]->annual_budget = $arr_clubs[$i][6];
				$clubs[$club_count]->president = $arr_clubs[$i][7];
				$clubs[$club_count++]->stadium = $arr_clubs[$i][8];
			}else{
				$clubs[$index]->leagues .= ";<br>" . $arr_clubs[$i][4];
			}
		}


		$sql = "SELECT c.`id`,ct.`count` 
					FROM `clubs` AS c
					INNER JOIN `clubs_trophies` AS ct, `trophies` AS tr
        			WHERE c.`id` = ct.`club_id`
        			AND ct.`trophy_id` = tr.`id`;";
		$arr_clubs = FootballClubs::select($sql);
		// for ($i=0; $i < $club_count; $i++) {
		// 		$flag = true;
		// 		$j=0;
		// 		while(($j<$count) && ($flag)){
		// 			if ($clubs[$j++]->id==$row[0]) {
		// 				$flag = false;
		// 			}
		// 		}	
		// 		$clubs[--$j]->trophy_count += $row[1];		
		// }

		for ($i=0; $i < count($arr_clubs); $i++) { 
			$flag = true;
			for($j=0;(($j<$club_count) && ($flag));$j++){
				if ($clubs[$j]->id==$arr_clubs[$i][0]) {
					$flag = false;
					$index = $j;
				}					
			}
			if($flag != true){
				$clubs[$index]->trophy_count += $arr_clubs[$i][1];
			}
		}

		$search = $_POST['search'];
		for ($j=0; $j < $club_count ; $j++) { 
			if($search==""){
			echo "<tr>";
			 	echo "<td>" . $clubs[$j]->name . "</td>";
			 	echo "<td>" . $clubs[$j]->town . "</td>";
				echo "<td>" . $clubs[$j]->country . "</td>";
				echo "<td>" . $clubs[$j]->leagues . "</td>";
				echo "<td>" . $clubs[$j]->year . "</td>"; 
				echo "<td>" . $clubs[$j]->trophy_count . "</td>";
				echo "<td>" . $clubs[$j]->annual_budget . "</td>";
				echo "<td>" . $clubs[$j]->president . "</td>";
				echo "<td>" . $clubs[$j]->stadium . "</td>";
			echo "</tr>";
			}
			else{
				if(mb_stripos($clubs[$j]->name,$search)!==false){
				echo "<tr>";
			 	echo "<td>" . $clubs[$j]->name . "</td>";
			 	echo "<td>" . $clubs[$j]->town . "</td>";
				echo "<td>" . $clubs[$j]->country . "</td>";
				echo "<td>" . $clubs[$j]->leagues . "</td>";
				echo "<td>" . $clubs[$j]->year . "</td>"; 
				echo "<td>" . $clubs[$j]->trophy_count . "</td>";
				echo "<td>" . $clubs[$j]->annual_budget . "</td>";
				echo "<td>" . $clubs[$j]->president . "</td>";
				echo "<td>" . $clubs[$j]->stadium . "</td>";
				echo "</tr>";
				}
			}
		}
	?>
</table>