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
		Count of trophys
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
		$result_id = mysql_query($sql);
		$i=0;
		while($row = mysql_fetch_row($result_id)){
				$flag = true;
				for ($j=0; ($j < $i) && ($flag); $j++) { 
					if($clubs[$j]->id == $row[0]){
						$flag = false;
						$index = $j;
					}
				}
				if($flag == true){
			 		$clubs[$i]->id = $row[0];
			 		$clubs[$i]->name = $row[1];
			 		$clubs[$i]->town_name = $row[2];
					$clubs[$i]->country_name = $row[3];
					$clubs[$i]->league_name = $row[4];
					$clubs[$i]->year = $row[5];
					$clubs[$i]->annual_budget = $row[6];
					$clubs[$i]->president_name = $row[7];
					$clubs[$i++]->stadion_name = $row[8];
				}else{
					$clubs[$index]->league_name .= ";<br>" . $row[4];
				}
		}
		$count = $i;
		$sql = "SELECT c.`id`,ct.`count` 
					FROM `clubs` AS c
					INNER JOIN `clubs_trophys` AS ct, `trophys` AS tr
        			WHERE c.`id` = ct.`club_id`
        			AND ct.`trophy_id` = tr.`id`;";
		$result_id = mysql_query($sql);
		while($row = mysql_fetch_row($result_id)){
				$flag = true;
				$j=0;
				while(($j<$count) && ($flag)){
					if ($clubs[$j]->id==$row[0]) {
						$flag = false;
					}
					$j++;
				}	
				$clubs[--$j]->trophy_count += $row[1];		
		}
		$search = $_POST['search'];
		for ($j=0; $j < $count ; $j++) { 
			if($search==""){
			echo "<tr>";
			 	echo "<td>" . $clubs[$j]->name . "</td>";
			 	echo "<td>" . $clubs[$j]->town_name . "</td>";
				echo "<td>" . $clubs[$j]->country_name . "</td>";
				echo "<td>" . $clubs[$j]->league_name . "</td>";
				echo "<td>" . $clubs[$j]->year . "</td>"; 
				echo "<td>" . $clubs[$j]->trophy_count . "</td>";
				echo "<td>" . $clubs[$j]->annual_budget . "</td>";
				echo "<td>" . $clubs[$j]->president_name . "</td>";
				echo "<td>" . $clubs[$j]->stadion_name . "</td>";
			echo "</tr>";
			}
			else{
				if(mb_stripos($clubs[$j]->name,$search)!==false){
				echo "<tr>";
			 	echo "<td>" . $clubs[$j]->name . "</td>";
			 	echo "<td>" . $clubs[$j]->town_name . "</td>";
				echo "<td>" . $clubs[$j]->country_name . "</td>";
				echo "<td>" . $clubs[$j]->league_name . "</td>";
				echo "<td>" . $clubs[$j]->year . "</td>"; 
				echo "<td>" . $clubs[$j]->trophy_count . "</td>";
				echo "<td>" . $clubs[$j]->annual_budget . "</td>";
				echo "<td>" . $clubs[$j]->president_name . "</td>";
				echo "<td>" . $clubs[$j]->stadion_name . "</td>";
				echo "</tr>";
				}
			}
		}
	?>
</table>