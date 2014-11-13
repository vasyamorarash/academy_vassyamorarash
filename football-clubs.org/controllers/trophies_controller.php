<?php
require("../models/clubs.php");
require("../models/clubs_leagues.php");
require("../models/clubs_trophies.php");
require("../models/countries.php");
require("../models/leagues.php");
require("../models/presidents.php");
require("../models/stadiums.php");
require("../models/towns.php");
require("../models/trophies.php");


switch($action){

    case "add":{
        include("../views/trophies/trophies_add.php");

        break;
    }

    case "delete":{
        include("../views/trophies/trophies_delete.php");

        break;
    }

    case "view":{
        include("../views/trophies/trophies_view.php");

        break;
    }

    case "update":{
        break;
    }
}
?>