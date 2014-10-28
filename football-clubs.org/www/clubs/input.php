<div class="input">
	<form class="input" action="" method="POST">
		<p>Club name: <input type="text" name="nameClub" size="30"></p>
		<p>Town: 
		<select name="townId" size="1">
			<option value=""></option>
			<?php
				$sql = "SELECT `towns`.`id`,`towns`.`name` FROM `towns` ORDER BY `towns`.`name` ASC";
				$result_id = mysql_query($sql);
				while($row = mysql_fetch_assoc($result_id)){					
	 				echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
				}
			?>
		</select></p>
		<p>Leagues:</p>
		<select name="leaguesId[]" multiple="multiple">
			<?php
				$sql = "SELECT `leagues`.`id`,`leagues`.`name` FROM `leagues` ORDER BY `leagues`.`name` ASC";
				$result_id = mysql_query($sql);
				while($row = mysql_fetch_assoc($result_id)){					
	 				echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
				}
			?>
		</select>
		<p>Year: <input type="year" name="year" size="3"></p>
		<p>Trophys:</p>
		<select name="trophysId[]" multiple="multiple">
			<?php
				$sql = "SELECT `trophys`.`id`,`trophys`.`name` FROM `trophys` ORDER BY `trophys`.`name` ASC";
				$result_id = mysql_query($sql);
				while($row = mysql_fetch_assoc($result_id)){					
	 				echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
				}
			?>
		</select>
		<input type="text" name="trophyCount" size="6">
		<p>Annual budget: <input type="text" name="budget" size="6"></p>
		<p>President: 
		<select name="presidentId" size="1">
			<option value=""></option>
			<?php
				$sql = "SELECT `presidents`.`id`,`presidents`.`name` FROM `presidents` ORDER BY `presidents`.`name` ASC";
				$result_id = mysql_query($sql);
				while($row = mysql_fetch_assoc($result_id)){					
	 				echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
				}
			?>
		</select></p>
		<p>Home stadium: 
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
		<input type="submit" name="send" value="Add club">
	</form>

<?php
if (isset ($_POST['send'])){

		$nameClub = $_POST['nameClub'];
		$townId = $_POST['townId'];
		$leaguesId = $_POST['leaguesId'];
		$year = $_POST['year'];
		$trophysId = $_POST['trophysId'];
		$trophyCount = $_POST['trophyCount'];
		$budget = $_POST['budget'];
		$presidentId = $_POST['presidentId'];
		$stadiumId = $_POST['stadiumId'];
		$flag = true;
		if(($nameClub!="") && ($townId!="") && (count($leaguesId)!=0) && (count($trophysId)!=0) && ($year!="") && ($trophyCount!="") && ($budget!="") && ($presidentId!="") && ($stadiumId!="")){

			if ((strlen($nameClub) >= 1) && (strlen($nameClub) <= 50)){
   				$nameClub = stripslashes($nameClub);
   				$nameClub = html_entity_decode($nameClub);
   				$nameClub = strip_tags($nameClub);
   			}
   			else{
   			echo "<center>It's wrong club name !<br><input name='back' type='button' value='Go back' onclick= 'javascript:history.back()'></center>";
   			$flag = false;
   			}

   			if (!(ctype_digit($year) && ($year  >= 1400) && ($year  <= 2014))){
   				echo "<center>It's wrong year !<br><input name='back' type='button' value='Go back' onclick= 'javascript:history.back()'></center>";
   				$flag = false;
   			}

   			if (!(ctype_digit($budget) && ($budget  >= 0) && ($budget  <= 2000000000000))){
   				echo "<center>It's wrong budget !<br><input name='back' type='button' value='Go back' onclick= 'javascript:history.back()'></center>";
   				$flag = false;
   			}
   			
   			if($flag){   				
   				$sql = "INSERT INTO `clubs` (`name`, `town_id`, `year`, `annual_budget`, `president_id`, `stadium_id`) 
   							VALUES ('$nameClub','$townId','$year','$budget','$presidentId','$stadiumId')";				
				$result_id = mysql_query($sql);
				$clubId=mysql_insert_id();
				for ($i=0; $i < count($leaguesId) ; $i++) { 
					$sql = "INSERT INTO `clubs_leagues` (`club_id`,`league_id`) VALUES ('$clubId','$leaguesId[$i]')";
					$result_id = mysql_query($sql);
					mysql_error($link_id);
				}
				$trophysCount = explode(" ", $trophyCount, count($trophysId));
				for ($i=0; $i < count($trophysId) ; $i++) { 
					$trophysCount[$i] = intval($trophysCount[$i]);
					$sql = "INSERT INTO `clubs_trophys` (`club_id`,`trophy_id`,`count`) VALUES ('$clubId','$trophysId[$i]','$trophysCount[$i]')";
					$result_id = mysql_query($sql);
					mysql_error($link_id);
				}
				
   			}			
		}
		else{
			echo "<center>Please fill in all fields !<br><input name='back' type='button' value='Go back' onclick= 'javascript:history.back()'></center>";
		}
		
	}
?>
</div>
<div class="delete">
	<form class="delete" action="" method="POST">
		<p>Delete: 
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
		<input type="submit" name="delete" value="Delete">
	</form>
	<?php
		if (isset ($_POST['delete'])){
			$clubId = $_POST['clubId'];
			$sql = "DELETE FROM `clubs_trophys` WHERE `clubs_trophys`.`club_id` = $clubId";
			$result_id = mysql_query($sql);
			$sql = "DELETE FROM `clubs_leagues` WHERE `clubs_leagues`.`club_id` = $clubId";
			$result_id = mysql_query($sql);
			$sql = "DELETE FROM `clubs` WHERE `clubs`.`id` = $clubId";
			$result_id = mysql_query($sql);
		}
	?>
</div>