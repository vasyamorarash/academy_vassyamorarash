<form class="search" action="" method="POST">
    <p><input type="text" name="search" size="30">
        <input type="submit" name="Search" value="Search"></p>
</form>
<form class="sort" action="" method="POST">
    <select name="sort" size="1">
        <option value=""></option>
        <option value="tr.`name`">Name</option>
        <option value="tr.`year`">Year</option>
    </select>
    <input type="submit" name="sorted" value="Sort"></p>
</form>

<a href="http://www.football-clubs.org/?controller=trophies&action=add" class="menu" >Add trophy</a>
<a href="http://www.football-clubs.org/?controller=trophies&action=delete" class="menu" >Delete trophy</a>

<table>
    <tr>
        <th>
            Trophies
        </th>
        <th>
            Year
        </th>
    </tr>
    <?php
    $search = $_POST['search'];
    $sort = $_POST['sort'];

    $tr = new Trophies();
    $arr_trophies = $tr->select_all_info($sort,$search);

    for ($i=0; $i < count($arr_trophies); $i++) {
        echo "<tr>";
        echo "<td>" . $arr_trophies[$i][0] . "</td>";
        echo "<td>" . $arr_trophies[$i][1] . "</td>";
        echo "</tr>";
    }
    ?>
</table>