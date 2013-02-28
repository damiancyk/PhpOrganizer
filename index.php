<?php
modifyHeader();
//checkSession();
initSessionForDamian();
 //phpinfo();
?>

<?php require("./documents/account/avatar.php"); ?>

<?php
function modifyHeader(){
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
}

function checkSession(){
if(!isset($_SESSION))session_start();
if(!isset($_SESSION['Logged'])){
if(isset($_GET['LoginAgain']))header('Location: documents/login/hello.php?LoginAgain=1');
else header('Location: documents/login/hello.php');
}
}

function initSessionForDamian(){
if(!isset($_SESSION))session_start();
$_SESSION['Logged']=1;
$_SESSION['Id_User']=1;
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-2" />
<title>Organizer</title>
<meta name="organizer praca magisterska" content="" />
<link rel="stylesheet" type="text/css" href="styles/base.css" />
<link rel="stylesheet" type="text/css" href="styles/form.css" />
<link rel="stylesheet" type="text/css" href="styles/contents.css" />
</head>
<body>

<div id="container">
	<div id="menuUp">
		<ul >
			<li><a href="?page=documents/organizer.php">ORGANIZER 2012</a></li>
			<li><a href="?page=documents/info.php">PRACA MGR</a></li>
			<li><a href="?page=documents/account/account.php">MOJE KONTO</a></li>
			<li><a href="documents/login/logout.php">WYLOGUJ</a></li>
			<li><a href="?page=documents/sesja.php">SESJA</a></li>
		</ul>
	</div>
	
	<div id="middle">
	<div id="menuLeft">
		<ul <a href="#">GRUPOWE</a> 
			<li><a href="?page=documents/task/task.php">ZADANIA</a></li>
			<li><a href="?page=documents/event/event.php">WYDARZENIA</a></li>
			<li><a href="?page=documents/team/team.php">TWOJE DRUZYNY</a></li>
			<li><a href="?page=documents/contact/contact.php">KONTAKTY</a></li>
		</ul>
		<ul <a href="#">LOKALNE</a>
			<li><a href="?page=documents/note/note.php">NOTATKI</a></li>
			<li><a href="?page=documents/diary/diary.php">DZIENNIK</a></li>
		</ul>
		<ul <a href="#">INNE</a>
			<li><a href="?page=documents/calculator.php">KALKULATOR</a></li>
			<li><a href="?page=documents/calendar/calendar.php">KALENDARZ</a></li>
			<li><a href="?page=documents/currency.php">KURSY WALUT</a></li>
			<li><a href="?page=documents/weather.php">POGODA</a></li>
		</ul>
		<div id="logged">

		<?php
$link = mysql_connect('localhost','root','');
mysql_select_db('db_organizer',$link);
if(isset($_SESSION['Id_User'])){
//print_r($_SESSION);
loadDataUser($_SESSION['Id_User']);
showGravatar($_SESSION['Email'], 75);
}else{
echo "<div id='messageBad'>";
echo 'Nie zalogowales sie!';
echo '</div>';
}
?>

<?
function loadDataUser($Id_User){
$query = "SELECT * FROM `User` WHERE `Id_User`=".$Id_User;
$result = mysql_query($query)or die('Error (query)');
	if (mysql_num_rows($result) > 0) {
	$user= mysql_fetch_object($result); 
	 $_SESSION['Firstname']=$user->Firstname;
	 $_SESSION['Lastname']=$user->Lastname;
	 $_SESSION['Email']=$user->Email;
	 echo "--- </br> Zalogowany:</br>".$_SESSION['Firstname']." ".$_SESSION['Lastname']."</br>---</br>";
	}else{
	echo 'Blad bazy!';
	}
	
	$query = "SELECT Login, Password FROM `Login` WHERE `Id_User`=".$Id_User;
	$result = mysql_query($query)or die('Error (query)');
	if (mysql_num_rows($result) > 0) {
	$user= mysql_fetch_object($result); 
	 $_SESSION['Login']=$user->Login;
	 $_SESSION['Password']=$user->Password;
	}else{
	echo 'Blad bazy!';
	}
}

?>

		</div>	
	</div>
	
		<div id="contents">
		
<?php
initSessionVariables();
if(isset($_GET['page'])&&file_exists($_GET['page'])) include $_GET['page'];
else
      include ("documents/organizer.php");
?>
	</div>

	</div>
<div id="footer">
Designed by Damian Pięta &copy
</div>
	</div>
</body>
</html>

<?php
function initSessionVariables(){
$date =time () ;
$_SESSION['date']= time () ;
 $_SESSION['day'] = date('d', $date) ; 
 $_SESSION['month'] = date('m', $date) ; 
 $_SESSION['year'] = date('Y', $date) ;
}


?>