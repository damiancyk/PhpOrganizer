<button id="buttonAction" onclick="window.location.href = '?page=documents/contact/contact.php'">< powrot </button>

<?php
$searchType='login';
$searchWord='';

if(isset($_POST['searchT']))$searchType=trim($_POST['searchT']);
if(isset($_POST['word']))$searchWord=trim($_POST['word']);
searchField($searchType);
searchContact($searchType, $searchWord);

if(isset($_GET['askAddContact']))askAddContact($_GET['askAddContact']);
if(isset($_GET['addContact']))addContact($_GET['addContact']);
?>

<?php
function searchField($searchType){
echo "<br/><br/><div class='box'>";
echo "<form action='?page=documents/contact/addContact.php' method='post'>";
echo '<label>';
echo 'szukanie wg (domyslnie login):  <br/>';
echo '<input type="radio" name="searchT" value="login"/> login</br>';
echo '<input type="radio" name="searchT" value="email"/> e-mail</br>';
echo '<input type="radio" name="searchT" value="firstname"/> imie </br>';
echo '<input type="radio" name="searchT" value="lastname"/> nazwisko</br>';
echo '</label>';
echo '<label>';
echo '<input type="text" class="inputSimple" name="word"/>';
echo "<input type='submit' id='buttonAction' name='searchButton' value='szukaj' />";
echo '</label>';
echo '</form>';
echo '</div>';
}

function searchContact($searchType, $word){
if($word!=''){
$query='';
 switch($searchType){
 case 'login':
  $query="SELECT User.*, Login.Login FROM User 
 INNER JOIN Login ON Login.Id_User=User.Id_User
 WHERE Login.Login='$word'
 ";
 break;
 
 case 'email':
  $query="SELECT User.*, Login.Login FROM User 
 INNER JOIN Login ON Login.Id_User=User.Id_User
 WHERE User.Email='$word'
 ";
 break;
 
 case 'firstname':
   $query="SELECT User.*, Login.Login FROM User 
 INNER JOIN Login ON Login.Id_User=User.Id_User
 WHERE User.Firstname='$word'
 ";
 break;
 
  case 'lastname':
   $query="SELECT User.*, Login.Login FROM User 
 INNER JOIN Login ON Login.Id_User=User.Id_User
 WHERE User.Lastname='$word'
 ";
 break;
 
 default:
   $query="SELECT User.*, Login.Login FROM User 
 INNER JOIN Login ON Login.Id_User=User.Id_User
 WHERE User.Lastname='$word'
 ";
 break;
 }
 $result = mysql_query($query) or die('Error (query)'); 
 echo 'wyniki wyszukiwania (wg '.$searchType.'):';
 showResult($result);
 
}else {
//echo 'puste pole wyszukawia!';
}
}

function showResult($result){
  if(mysql_num_rows($result) > 0) { 

    while ($r = mysql_fetch_object($result)) {
	echo "<div id='boxContact'>";
		echo "<button onclick='window.location.href = \"?page=documents/contact/addContact.php&askAddContact=$r->Id_User\"'>";
		
	echo "<div id='avatar'>";
	showGravatar($r->Email, 40);
	echo '</div>';

	echo "<span class='title'>Imie: </span>".$r->Firstname."<br/>";
	echo "<span class='title'>Nazwisko: </span>".$r->Lastname."<br/>";
	echo "<span class='title'>Email: </span>".$r->Email."<br/>";
	echo "<span class='title'>Login: </span>".$r->Login."<br/>";
	echo '(kliknij, aby dodac kontakt)';
	
	echo '	</button>';
	echo '</div>';

	}
}
}

function askAddContact($idContact){
echo '&nbsp&nbsp&nbsp  dodac? ';
echo "<a href='?page=documents/contact/addContact.php&addContact=$idContact'>  tak </a>";
echo "&nbsp&nbsp / &nbsp&nbsp";
echo "<a href='?page=documents/contact/addContact.php'>  nie </a>";
}

function addContact($idContact){
if($idContact!=$_SESSION['Id_User']){
$query="SELECT COUNT(Id_Contact) FROM Contact WHERE Id_Position = '$idContact' AND Id_Owner=".$_SESSION['Id_User'];
$result=mysql_query($query) or die('Error (queryCount)'); 
$wynik = mysql_fetch_assoc($result);
if($wynik['COUNT(Id_Contact)']>0){
echo '..masz juz ten kontakt na liscie!..';
}else{
$query="INSERT INTO Contact (Id_Owner, Id_Position) VALUES 
(".$_SESSION['Id_User'].", $idContact)";
mysql_query($query) or die('Error (queryInsert)'); 
echo '..dodano kontakt..';
header('Location: ?page=documents/contact/addContact.php');
}
}else{
echo '..probujesz dodac samego siebie!..';
}
}
?>
