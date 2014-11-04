<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Clubs</title>
		<link rel="stylesheet" type="text/css" href="../style.css">
		<link rel="shortcut icon" href="../football-icon.png">
	</head>
	<body>
		<div class="main">
			<div class="header">
				<?php
					require("header.php");
				?>	
			</div>
			<div class="menu">
				<?php
					require("../menu.php");
				?>				
			</div>
			<div class="info">
				<?php
					require("../../model/football_clubs.php");
					require("info.php");
				?>
			</div>
			<div class="footer">
				<?php
					require("../footer.php");
				?>
			</div>
		</div>
	</body>
</html>