<div class="input">
	<form class="input" action="" method="POST">
		<p>Stadium name: <input type="text" name="nameStadium" size="30"></p>
		<p>Year: <input type="text" name="year" size="3"></p>
		<p>Capacity: <input type="text" name="capacity" size="3"></p>
		<input type="submit" name="send" value="Add stadium">
	</form>

<?php
if (isset ($_POST['send'])){

		$nameStadium = $_POST['nameStadium'];
		$year = $_POST['year'];
		$capacity = $_POST['capacity'];
		$flag = true;
		if(($nameStadium!="") && ($year!="") && ($capacity!="")){

			if ((strlen($nameStadium) >= 1) && (strlen($nameStadium) <= 50)){
   				$nameStadium = stripslashes($nameStadium);
   				$nameStadium = html_entity_decode($nameStadium);
   				$nameStadium = strip_tags($nameStadium);
   			}
   			else{
   			echo "<center>It's wrong stadium name !<br><input name='back' type='button' value='Go back' onclick= 'javascript:history.back()'></center>";
   			$flag = false;
   			}

   			if (!(ctype_digit($year) && ($year  >= 1000) && ($year  <= 2014))){
   				echo "<center>It's wrong year !<br><input name='back' type='button' value='Go back' onclick= 'javascript:history.back()'></center>";
   				$flag = false;
   			}

   			if (!(ctype_digit($capacity) && ($capacity  >= 0) && ($capacity  <= 10000000000))){
   				echo "<center>It's wrong capacity !<br><input name='back' type='button' value='Go back' onclick= 'javascript:history.back()'></center>";
   				$flag = false;
   			}
   			
   			if($flag){   				
   				$sql = "INSERT INTO `stadiums` (`name`, `year`, `capacity`) 
   							VALUES ('$nameStadium','$year','$capacity')";				
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
      <input type="submit" name="delete" value="Delete">
   </form>
   <?php
      if (isset ($_POST['delete'])){
         $stadiumId = $_POST['stadiumId'];
         $sql = "DELETE FROM `stadiums` WHERE `stadiums`.`id` = $stadiumId";
         $result_id = mysql_query($sql);
      }
   ?>
</div>