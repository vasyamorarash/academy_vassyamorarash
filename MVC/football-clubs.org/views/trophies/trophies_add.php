<div class="input">
    <form class="input" action="" method="POST">
        <p>Trophy name: <input type="text" name="name" size="30"></p>
        <p>Year: <input type="text" name="year" size="3"></p>
        <input type="submit" name="add_trophy" value="Add trophy">
        <?php
        if (isset ($_POST['send'])){
            $array = Array(name=>$_POST['name'],year=>$_POST['year']);
            $tr = new Trophies();
            $tr->add_to_db($array);
        }
        ?>
    </form>
</div>