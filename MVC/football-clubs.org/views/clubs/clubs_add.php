     <form class="input" action="" method="POST">
          <p>Club name: <input type="text" name="name" size="30"></p>
          <p>Town: 
          <select name="town_id" size="1">
               <option value=""></option>
               <?php
                    $t = new Towns();
                    $array = $t->select_all();
                    for ($i=0; $i < count($array) ; $i++){                      
                         echo '<option value="' . $array[$i]['id'] . '">' . $array[$i]['name'] . '</option>';
                    }
               ?>
          </select></p>
          <p>Leagues:</p>
          <select name="leaguesId[]" multiple="multiple">
               <?php
                    $l = new Leagues();
                    $array = $l->select_all();
                    for ($i=0; $i < count($array) ; $i++){                      
                         echo '<option value="' . $array[$i]['id'] . '">' . $array[$i]['name'] . '</option>';
                    }
               ?>
          </select>
          <p>Year: <input type="year" name="year" size="3"></p>
          <p>Trophies:</p>
          <select name="trophiesId[]" multiple="multiple">
               <?php
                    $tr = new Trophies();
                    $array = $tr->select_all();
                    for ($i=0; $i < count($array) ; $i++){                      
                         echo '<option value="' . $array[$i]['id'] . '">' . $array[$i]['name'] . '</option>';
                    }
               ?>
          </select>
          <input type="text" name="trophiesCount" size="6">
          <p>Annual budget: <input type="text" name="annual_budget" size="6"></p>
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
          <p>Home stadium: 
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
          <input type="submit" name="add_club" value="Add club">
<?php
     if (isset ($_POST['add_club'])){
                    $array = Array(name=>$_POST['name'],town_id=>$_POST['town_id'],
                         year=>$_POST['year'],annual_budget=>$_POST['annual_budget'],
                         president_id=>$_POST['president_id'],stadium_id=>$_POST['stadium_id']);
                    $c = new Clubs();
                    $c->add_to_db($array);

                    $leaguesId = $_POST['leaguesId'];
                    $trophiesId = $_POST['trophiesId'];
                    $trophiesCount = $_POST['trophiesCount'];

                    $clubId=$c->get_last_id();
                    for ($i=0; $i < count($leaguesId) ; $i++) { 
                         $array = Array(club_id=>$clubId,league_id=>$leaguesId[$i]);
                         $cl = new Clubs_Leagues();
                         $cl->add_to_db($array);
                    }
                    $trophiesCount = explode(" ", $trophiesCount, count($trophiesId));
                    for ($i=0; $i < count($trophiesId) ; $i++) { 
                         $trophiesCount[$i] = intval($trophiesCount[$i]);
                         $array = Array(club_id=>$clubId,trophy_id=>$trophiesId[$i],count=>$trophiesCount[$i]);
                         $cl = new Clubs_Trophies();
                         $cl->add_to_db($array);
                    }
               }
?>
     </form>
