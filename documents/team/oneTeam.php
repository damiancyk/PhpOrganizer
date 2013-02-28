<?php
if(isset($_GET['idUT']))$_SESSION['idUT']=$_GET['idUT'];

echo "<div id='boxTeamFull'>";
echo '<button id="buttonAction" onclick="window.location.href = \'?page=documents/team/team.php\'">< powrot</button> <br/>';

showTeam($_SESSION['idUT']);

echo '</div>';

?>


<?php
function showTeam($idUT){

 $query="SELECT Team.*, User_Team.* FROM Team 
 INNER JOIN User_Team ON Team.Id_Team=User_Team.Id_Team
 WHERE User_Team.Id_User_Team=$idUT
 ";
 $result = mysql_query($query) or die('Error (query)'); 
  
  if(mysql_num_rows($result) > 0) { 

    while ($r = mysql_fetch_object($result)) {
	

echo "<span class='title'>DRUZYNA </span> <br/>";
	echo '-----<br/>';
echo "<span class='title'>Nazwa: </span>".$r->Name."<br/>";
echo "<span class='title'>Opis: </span>".$r->Description."<br/>";
echo '-----<br/>';
	echo "<button id='buttonAction' onclick='window.location.href = \"?page=documents/team/oneTeam.php&idTeam=$r->Id_Team\"'>";
echo 'usun / wypisz sie	</button>';

	}
}

}

function askDelTeam($idPosition){
echo '&nbsp&nbsp&nbsp  usunac? ';
echo "<a href='?page=documents/contact/contact.php&delPosition=$idPosition'>  tak </a>";
echo "&nbsp&nbsp / &nbsp&nbsp";
echo "<a href='?page=documents/contact/contact.php'>  nie </a>";
}

function delTeam($idPosition){
 $query="DELETE FROM Contact WHERE Id_Owner=".$_SESSION['Id_User']." AND Id_Position = ".$idPosition;
mysql_query($query) or die('Error (queryDelete)'); 
echo '..usunieto kontakt..';
}
?>