<div class="delete">
    <form class="delete" action="" method="POST">
        <p>Delete:
            <select name="trophy_id" size="1">
                <option value=""></option>
                <?php
                $tr = new Trophies();
                $array = $tr->select_all();
                for ($i=0; $i < count($array) ; $i++){
                    echo '<option value="' . $array[$i]['id'] . '">' . $array[$i]['name'] . '</option>';
                }
                ?>
            </select></p>
        <input type="submit" name="delete" value="Delete">
    </form>
    <?php
    if (isset ($_POST['delete'])){
        $tr->delete_from_db($_POST['trophy_id']);
    }
    ?>
</div>