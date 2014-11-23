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
        include("../views/stadiums/stadiums_add.php");

        break;
    }

    case "delete":{
        include("../views/stadiums/stadiums_delete.php");

        break;
    }

    case "view":{
        include("../views/stadiums/stadiums_view.php");

        break;
    }

    case "update":{
        break;
    }
}
?>