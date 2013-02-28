<?php require("./documents/calendar/translation.php"); ?>

<button id="buttonAction" onclick="window.location.href = '?page=documents/contact/addContact.php'">szukaj kontaktow</button> <br/>
<?php
showContacts($_SESSION['Id_User']);
?>

<?php
function showContacts($idUser){
 $query="SELECT User.*, Login.Login, Contact.* FROM User 
 INNER JOIN Contact ON Contact.Id_Position=User.Id_User
 INNER JOIN Login ON Login.Id_User=User.Id_User
 WHERE Contact.Id_Owner=$idUser
 ";
 $result = mysql_query($query) or die('Error (query)'); 
 
 echo '---------<br/>Twoje kontakty:<br/>---';
 
  if(mysql_num_rows($result) > 0) { 

    while ($r = mysql_fetch_object($result)) {
	echo "<div id='boxContact'>";
	
	echo "<button onclick='window.location.href = \"?page=documents/contact/oneContact.php&idContact=$r->Id_Contact\"'>";
			echo "<div id='avatar'>";
		showGravatar($r->Email, 20);
	echo '</div>';
	echo $r->Firstname.'   '.$r->Lastname.' / <i>';
	echo '`'.$r->Login.'`';

echo '	</button>';
	echo '</div>';

	}
}

}

?>