<?php
require('connect_to_db.php');

?>
<form class="search" action="" method="POST">
		<p>League: 
		<select name="leagueId" size="1">
			<option value=""></option>
			<?php
				$sql = "SELECT `leagues`.`id`,`leagues`.`name` FROM `leagues` ORDER BY `leagues`.`name` ASC";
				$result_id = mysql_query($sql);
				while($row = mysql_fetch_assoc($result_id)){					
	 				echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
				}
			?>
		</select></p>
		<p>Trophy: 
		<select name="trophyId" size="1">
			<option value=""></option>
			<?php
				$sql = "SELECT `trophies`.`id`,`trophies`.`name` FROM `trophies` ORDER BY `trophies`.`name` ASC";
				$result_id = mysql_query($sql);
				while($row = mysql_fetch_assoc($result_id)){					
	 				echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
				}
			?>
		</select></p>
		<p>Stadium: 
		<select name="stadiumId" size="1">
			<option value=""></option>
			<?php
				$sql = "SELECT `stadiums`.`id`,`stadiums`.`name` FROM `stadiums` ORDER BY `stadiums`.`name` ASC";
				$result_id = mysql_query($sql);
				while($row = mysql_fetch_assoc($result_id)){					
	 				echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
				}
			?>
		</select></p>
		<input type="submit" name="output" value="Search"></p>
</form>
<table>
	<tr>
		<th>
		Club
		</th>
	</tr>

<?php
if (isset ($_POST['output'])){
	$leagueId = $_POST['leagueId'];
	$trophyId = $_POST['trophyId'];
	$stadiumId = $_POST['stadiumId'];
	$sql = "SELECT c.`name` 
					FROM `clubs` AS c
					INNER JOIN `clubs_leagues` AS cl, `clubs_trophies` AS ct
					WHERE c.`id` = cl.`club_id` AND c.`id` = ct.`club_id`
					AND cl.`league_id` = $leagueId AND ct.`trophy_id` = $trophyId
					AND c.`stadium_id` = $stadiumId";
	$arr = FootballClubs::select($sql);
		for ($i=0; $i < count($arr); $i++) {
			echo "<tr>";
			 	echo "<td>" . $arr[$i][0] . "</td>";
			echo "</tr>";
		}
}
?>
</table>
<form class="search" action="" method="POST">
		<p>Club: 
		<select name="clubId" size="1">
			<option value=""></option>
			<?php
				$sql = "SELECT `clubs`.`id`,`clubs`.`name` FROM `clubs` ORDER BY `clubs`.`name` ASC";
				$result_id = mysql_query($sql);
				while($row = mysql_fetch_assoc($result_id)){					
	 				echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
				}
			?>
		</select></p>
	<input type="submit" name="club_trophies" value="Search"></p>
</form>
<table>
	<tr>
		<th>
		Trophy
		</th>
	</tr>
<?php
if (isset ($_POST['club_trophies'])){
	$clubId = $_POST['clubId'];
	$sql = "SELECT tr.`name` 
					FROM `trophies` AS tr
					INNER JOIN `clubs` AS c,`clubs_trophies` AS ct
					WHERE c.`id` = ct.`club_id`  AND ct.`trophy_id` = tr.`id`
					AND c.`id` = $clubId";
	$arr = FootballClubs::select($sql);
		for ($i=0; $i < count($arr); $i++) {
			echo "<tr>";
			 	echo "<td>" . $arr[$i][0] . "</td>";
			echo "</tr>";
		}
}
?>
</table>