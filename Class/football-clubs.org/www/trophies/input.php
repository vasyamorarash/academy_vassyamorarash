<div class="input">
	<form class="input" action="" method="POST">
		<p>Trophy name: <input type="text" name="nameTrophy" size="30"></p>
		<p>Year: <input type="text" name="year" size="3"></p>
		<input type="submit" name="send" value="Add trophy">
	</form>

<?php
if (isset ($_POST['send'])){

		$nameTrophy = $_POST['nameTrophy'];
		$year = $_POST['year'];
		$flag = true;
		if(($nameTrophy!="") && ($year!="")){

			if ((strlen($nameTrophy) >= 1) && (strlen($nameTrophy) <= 50)){
   				$nameTrophy = stripslashes($nameTrophy);
   				$nameTrophy = html_entity_decode($nameTrophy);
   				$nameTrophy = strip_tags($nameTrophy);
   			}
   			else{
   			echo "<center>It's wrong trophy name !<br><input name='back' type='button' value='Go back' onclick= 'javascript:history.back()'></center>";
   			$flag = false;
   			}

   			if (!(ctype_digit($year) && ($year  >= 1000) && ($year  <= 2014))){
   				echo "<center>It's wrong year !<br><input name='back' type='button' value='Go back' onclick= 'javascript:history.back()'></center>";
   				$flag = false;
   			}
   			
   			if($flag){ 
				$array = Array(name=>$nameTrophy,year=>$year);
				$trophy = new Trophies();
				$trophy->insert($array);							
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
		<input type="submit" name="delete" value="Delete">
	</form>
	<?php
		if (isset ($_POST['delete'])){
			$trophyId = $_POST['trophyId'];
			Trophies::delete($trophyId);
		}
	?>
</div>