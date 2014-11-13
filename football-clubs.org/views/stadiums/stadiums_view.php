<form class="search" action="" method="POST">
    <p><input type="text" name="search" size="30">
        <input type="submit" name="Search" value="Search"></p>
</form>
<form class="sort" action="" method="POST">
    <select name="sort" size="1">
        <option value=""></option>
        <option value="s.`name`">Name</option>
        <option value="s.`year`">Year</option>
        <option value="s.`capacity`">Capacity</option>
    </select>
    <input type="submit" name="sorted" value="Sort"></p>
</form>

<a href="http://www.football-clubs.org/?controller=stadiums&action=add" class="menu" >Add stadium</a>
<a href="http://www.football-clubs.org/?controller=stadiums&action=delete" class="menu" >Delete stadium</a>

<table>
    <tr>
        <th>
            Stadium
        </th>
        <th>
            Year
        </th>
        <th>
            Capacity
        </th>
    </tr>
    <?php
    $search = $_POST['search'];
    $sort = $_POST['sort'];

    $s = new Stadiums();
    $arr_stadiums = $s->select_all_info($sort,$search);
    for ($i=0; $i < count($arr_stadiums); $i++) {
        echo "<tr>";
        echo "<td>" . $arr_stadiums[$i][0] . "</td>";
        echo "<td>" . $arr_stadiums[$i][1] . "</td>";
        echo "<td>" . $arr_stadiums[$i][2] . "</td>";
        echo "</tr>";
    }
    ?>
</table>