<div class="delete">
    <form class="delete" action="" method="POST">
        <p>Delete:
            <select name="stadium_id" size="1">
                <option value=""></option>
                <?php
                $s = new Stadiums();
                $array = $s->select_all();
                for ($i=0; $i < count($array) ; $i++){
                    echo '<option value="' . $array[$i]['id'] . '">' . $array[$i]['name'] . '</option>';
                }
                ?>
            </select></p>
        <input type="submit" name="delete" value="Delete">
        <?php
        if (isset ($_POST['delete'])){
            $s->delete_from_db($_POST['stadium_id']);
        }
        ?>
    </form>
</div>