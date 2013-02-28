<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Organizer</title>
<meta name="organizer praca magisterska" content="" />
<link rel="stylesheet" type="text/css" href="../../styles/base.css" />
<link rel="stylesheet" type="text/css" href="../../styles/hello.css" />
</head>
<body>

<div id="container">

	<div id="menuUp">
		<ul >
			<li><a href="?page=login.php">LOGOWANIE</a></li>
			<li><a href="?page=register.php">ZAREJESTRUJ SIE</a></li>
		</ul>
	</div>
	
	<div id="middle">
	
		<div id="contents">
<?php
if(isset($_GET['LoginAgain']))echo '>> sesja utracona, zaloguj sie ponownie';
if(isset($_GET['page'])&&file_exists($_GET['page'])) include $_GET['page'];
else include ("login.php");
?>
		</div>

	</div>

<div id="footer">
Copyright by Damian Pieta
</div>
	</div>
</body>
</html>