<form class="search" action="" method="POST">
    <p>League:
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
    <p>Trophy:
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
    <p>Stadium:
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
    <input type="submit" name="output" value="Search"></p>
</form>
<table>
    <tr>
        <th>
            Club
        </th>
    </tr>

    <?php
    if (isset ($_POST['output'])){

        $c = new Clubs();
        $arr = $c->get_club_by_parameters($_POST['league_id'],$_POST['trophy_id'],$_POST['stadium_id']);

        for ($i=0; $i < count($arr); $i++) {
            echo "<tr>";
            echo "<td>" . $arr[$i][0] . "</td>";
            echo "</tr>";
        }
    }
    ?>
</table>
<form class="search" action="" method="POST">
    <p>Club:
        <select name="club_id" size="1">
            <option value=""></option>
            <?php
            $c = new Clubs();
            $array = $c->select_all();
            for ($i=0; $i < count($array) ; $i++){
                echo '<option value="' . $array[$i]['id'] . '">' . $array[$i]['name'] . '</option>';
            }
            ?>
        </select></p>
    <input type="submit" name="club_trophies" value="Search"></p>
</form>
<table>
    <tr>
        <th>
            Trophy
        </th>
    </tr>
    <?php
    if (isset ($_POST['club_trophies'])){

        $tr = new Trophies();
        $arr = $tr->get_trophies_by_club($_POST['club_id']);
        for ($i=0; $i < count($arr); $i++) {
            echo "<tr>";
            echo "<td>" . $arr[$i][0] . "</td>";
            echo "</tr>";
        }
    }
    ?>
</table>