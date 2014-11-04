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
		<p>Trophies:</p>
		<select name="trophiesId[]" multiple="multiple">
			<?php
				$sql = "SELECT `trophies`.`id`,`trophies`.`name` FROM `trophies` ORDER BY `trophies`.`name` ASC";
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
		$trophiesId = $_POST['trophiesId'];
		$trophyCount = $_POST['trophyCount'];
		$budget = $_POST['budget'];
		$presidentId = $_POST['presidentId'];
		$stadiumId = $_POST['stadiumId'];
		$flag = true;
		if(($nameClub!="") && ($townId!="") && (count($leaguesId)!=0) && (count($trophiesId)!=0) && ($year!="") && ($trophyCount!="") && ($budget!="") && ($presidentId!="") && ($stadiumId!="")){

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
   				$array = Array(name=>$nameClub,town_id=>$townId,year=>$year,annual_budget=>$budget,president_id=>$presidentId,stadium_id=>$stadiumId);
   				$club = new Clubs();
   				$club->insert($array);
				$clubId=mysql_insert_id();
				for ($i=0; $i < count($leaguesId) ; $i++) { 
					$array = Array(club_id=>$clubId,league_id=>$leaguesId[$i]);
					$cl = new Clubs_Leagues();
					$cl->insert($array);
				}
				$trophiesCount = explode(" ", $trophyCount, count($trophiesId));
				for ($i=0; $i < count($trophiesId) ; $i++) { 
					$trophiesCount[$i] = intval($trophiesCount[$i]);
					$array = Array(club_id=>$clubId,trophy_id=>$trophiesId[$i],count=>$trophiesCount[$i]);
					$ct = new Clubs_Trophies();
					$ct->insert($array);
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
			Clubs::delete($clubId);
		}
	?>
</div>