<div class="delete">
	<form class="delete" action="" method="POST">
		<p>Delete: 
		<select name="league_id" size="1">
			<option value=""></option>
			<?php
				$l = new Leagues();
				$array = $l->select_all();
				for ($i=0; $i < count($array) ; $i++){					
	 				echo '<option value="' . $array[$i]['id'] . '">' . $array[$i]['name'] . '</option>';
				}
			?>
		</select></p>
		<input type="submit" name="delete" value="Delete">
	<?php
		if (isset ($_POST['delete'])){
            $l->delete_from_db($_POST['league_id']);
        }
	?>
	</form>
</div>