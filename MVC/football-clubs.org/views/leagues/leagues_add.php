<div class="input">
	<form class="input" action="" method="POST">
		<p>League name: <input type="text" name="name" size="30"></p>
		<p>Coutry: 
		<select name="country_id" size="1">
			<option value=""></option>
			<?php
                    $co = new Countries();
                    $array = $co->select_all();
                    for ($i=0; $i < count($array) ; $i++){                      
                         echo '<option value="' . $array[$i]['id'] . '">' . $array[$i]['name'] . '</option>';
                    }
               ?>
		</select></p>
		<p>UEFA rating: <input type="text" name="uefa_rating" size="3"></p>
		<p>President: 
		<select name="president_id" size="1">
			<option value=""></option>
			<?php
				$p = new Presidents();
                    $array = $p->select_all();
                    for ($i=0; $i < count($array) ; $i++){                      
                         echo '<option value="' . $array[$i]['id'] . '">' . $array[$i]['name'] . '</option>';
                    }
			?>
		</select></p>
		<input type="submit" name="add_league" value="Add league">
		<?php
if (isset ($_POST['add_league'])){
		$array = Array(name=>$_POST['name'],country_id=>$_POST['country_id'],
						uefa_rating=>$_POST['uefa_rating'],president_id=>$_POST['president_id']);
        $l = new Leagues();
        $l->add_to_db($array);
}
?>
</form>
</div>
