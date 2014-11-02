<?php
	require('Z:\home\football-clubs.org\_data\connect.php');
	if (!$link_id){
		$link_id = mysql_connect($db_lc,$db_login,$db_password);
	}else{
		die("Can't create connection!" . mysql_error());
	}
	mysql_select_db($db_name,$link_id);

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
				$sql = "SELECT `trophys`.`id`,`trophys`.`name` FROM `trophys` ORDER BY `trophys`.`name` ASC";
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
					INNER JOIN `clubs_leagues` AS cl, `clubs_trophys` AS ct
					WHERE c.`id` = cl.`club_id` AND c.`id` = ct.`club_id`
					AND cl.`league_id` = $leagueId AND ct.`trophy_id` = $trophyId
					AND c.`stadium_id` = $stadiumId";
	$result_id = mysql_query($sql);
	while($row = mysql_fetch_row($result_id)){
		echo "<tr>";
			 	echo "<td>" . $row[0] . "</td>";
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
	<input type="submit" name="club_trophys" value="Search"></p>
</form>
<table>
	<tr>
		<th>
		Trophy
		</th>
	</tr>
<?php
if (isset ($_POST['club_trophys'])){
	$clubId = $_POST['clubId'];
	$sql = "SELECT tr.`name` 
					FROM `trophys` AS tr
					INNER JOIN `clubs` AS c,`clubs_trophys` AS ct
					WHERE c.`id` = ct.`club_id`  AND ct.`trophy_id` = tr.`id`
					AND c.`id` = $clubId";
	$result_id = mysql_query($sql);
	while($row = mysql_fetch_row($result_id)){
		echo "<tr>";
			 	echo "<td>" . $row[0] . "</td>";
			echo "</tr>";
	}
}
?>
</table>