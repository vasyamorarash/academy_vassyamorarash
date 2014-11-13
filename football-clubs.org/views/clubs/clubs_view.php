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
<a href="http://www.football-clubs.org/?controller=clubs&action=add" class="menu" >Add club</a>
<a href="http://www.football-clubs.org/?controller=clubs&action=delete" class="menu" >Delete clubs</a>
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
		$search = $_POST['search'];

		$arr_clubs = Clubs::select_all_info($sort,$search);
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



		$arr_clubs = Clubs::select_count_trophy();

		

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

		
		for ($j=0; $j < $club_count ; $j++) {
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
	?>
</table>