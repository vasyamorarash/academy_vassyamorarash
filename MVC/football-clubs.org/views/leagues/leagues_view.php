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

<a href="http://www.football-clubs.org/?controller=leagues&action=add" class="menu" >Add league</a>
<a href="http://www.football-clubs.org/?controller=leagues&action=delete" class="menu" >Delete league</a>

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
		
		$league = new Leagues();
		$arr_leagues = $league->select_all_info($sort,$search);
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