<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Football Clubs</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="shortcut icon" href="football-icon.png">
	</head>
	<body>
		<div class="main">
			<div class="header">
                <div class="logo-left">
                    <a href="http://www.football-clubs.org/"><img src="logo-left.png" /></a>
                </div>
                <div class="header-text">
                    Football Clubs
                </div>
			</div>
			<div class="menu">
				<a href="http://www.football-clubs.org/?controller=clubs&action=view" class="menu" >Clubs</a>
				<a href="http://www.football-clubs.org/?controller=leagues&action=view" class="menu" >Leagues</a>
				<a href="http://www.football-clubs.org/?controller=stadiums&action=view" class="menu" >Stadiums</a>
                <a href="http://www.football-clubs.org/?controller=trophies&action=view" class="menu" >Trophies</a>
			</div>
			<div class="content">
                <?php
                	require("../config/connect.php");
					if (!$link_id){
						$link_id = mysql_connect($db_lc,$db_login,$db_password);
					}else{
						die("Can't create connection!" . mysql_error());
					}
					mysql_select_db($db_name,$link_id);
                	require("../models/football_clubs.php");
                    $controller = $_GET['controller'];
                    $action = $_GET['action'];
                    switch($controller){
                    	case "clubs":{
                    		include("../controllers/clubs_controller.php");
                    		break;
                    	}
                    	case "leagues":{
                    		include("../controllers/leagues_controller.php");
                    		break;
                    	}
                        case "stadiums":{
                            include("../controllers/stadiums_controller.php");
                            break;
                        }
                    	case "trophies":{
                    		include("../controllers/trophies_controller.php");
                    		break;
                    	}
                        case "":{
                            include("../controllers/main_controller.php");
                        }
                    }
                ?>
			</div>
			<div class="footer">
                <hr>
                <h5>&copy; All rights reserved 2014</h5>
			</div>
		</div>
	</body>
</html>