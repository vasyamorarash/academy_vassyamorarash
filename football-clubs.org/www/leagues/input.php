<div class="input">
	<form class="input" action="" method="POST">
		<p>League name: <input type="text" name="nameLeague" size="30"></p>
		<p>Coutry: 
		<select name="countryId" size="1">
			<option value=""></option>
			<?php
				$sql = "SELECT `countries`.`id`,`countries`.`name` FROM `countries` ORDER BY `countries`.`name` ASC";
				$result_id = mysql_query($sql);
				while($row = mysql_fetch_assoc($result_id)){					
	 				echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
				}
			?>
		</select></p>
		<p>UEFA rating: <input type="text" name="rating" size="3"></p>
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
		<input type="submit" name="send" value="Add league">
	</form>

<?php
if (isset ($_POST['send'])){

		$nameLeague = $_POST['nameLeague'];
		$countryId = $_POST['countryId'];
		$rating = $_POST['rating'];
		$presidentId = $_POST['presidentId'];
		$flag = true;
		if(($nameLeague!="") && ($countryId!="") && ($rating!="") && ($presidentId!="")){

			if ((strlen($nameLeague) >= 1) && (strlen($nameLeague) <= 50)){
   				$nameLeague = stripslashes($nameLeague);
   				$nameLeague = html_entity_decode($nameLeague);
   				$nameLeague = strip_tags($nameLeague);
   			}
   			else{
   			echo "<center>It's wrong league name !<br><input name='back' type='button' value='Go back' onclick= 'javascript:history.back()'></center>";
   			$flag = false;
   			}

   			if (!(ctype_digit($rating) && ($rating  >= 1) && ($rating  <= 2014))){
   				echo "<center>It's wrong UEFA rating !<br><input name='back' type='button' value='Go back' onclick= 'javascript:history.back()'></center>";
   				$flag = false;
   			}
   			
   			if($flag){   				
   				$sql = "INSERT INTO `leagues` (`name`, `country_id`, `uefa_rating`, `president_id`) 
   							VALUES ('$nameLeague','$countryId','$rating','$presidentId')";				
				$result_id = mysql_query($sql);							
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
		<input type="submit" name="delete" value="Delete">
	</form>
	<?php
		if (isset ($_POST['delete'])){
			$leagueId = $_POST['leagueId'];
			$sql = "DELETE FROM `clubs_leagues` WHERE `clubs_leagues`.`league_id` = $leagueId";
			$result_id = mysql_query($sql);
			$sql = "DELETE FROM `leagues` WHERE `leagues`.`id` = $leagueId";
			$result_id = mysql_query($sql);
		}
	?>
</div>