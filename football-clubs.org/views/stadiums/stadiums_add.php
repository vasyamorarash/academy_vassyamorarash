<div class="input">
    <form class="input" action="" method="POST">
        <p>Stadium name: <input type="text" name="name" size="30"></p>
        <p>Year: <input type="text" name="year" size="3"></p>
        <p>Capacity: <input type="text" name="capacity" size="3"></p>
        <input type="submit" name="add_stadium" value="Add stadium">
        <?php
        if (isset ($_POST['add_stadium'])){
            $array = Array(name=>$_POST['name'],year=>$_POST['year'],capacity=>$_POST['capacity']);
            $s = new Stadiums();
            $s->add_to_db($array);
        }
        ?>
    </form>
</div>
