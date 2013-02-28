<?php require("./documents/login/check.php"); ?>

<button id="buttonAction" onclick="window.location.href = '?page=documents/note/note.php'">< powrot</button>
</br>
<form action="?page=documents/note/addNote.php" method="post"> 
<div class="box">
<h1>Dodaj notatke</h1>

<label>
<span>Temat :</span>
<input type="text" class="inputSimple" name="tytul"/>
</label>
<label>
<span>Wiadomosc :</span>
    <textarea class="message"  name="tresc"/>
</textarea>
<input type="submit" class="button" value="Dodaj" /> 
</label>
 <?php
if(isset($_POST['tytul'])&&isset($_POST['tresc']))
{
$tytul=$_POST['tytul'];
$tresc=$_POST['tresc'];
$czasUtworzenia=date('U');
$czasEdycji=date('U');
if($tytul!=''&&$tresc!=''){
$link = mysql_connect('localhost','root','');
mysql_select_db('db_organizer',$link);
addNote($tytul, $tresc, $czasUtworzenia, $czasEdycji);
echo '<div id="messageGood"> !!pomyslnie dodales dane!! </div>';
}else{
echo ' <div id="messageBad"> !!uzupelnij prawidlowo wszystkie pola!! </div>';
}
}
?>
</div>

  
</form>

 <?php


function addNote($tytul, $tresc, $czasUtworzenia, $czasEdycji) { 
$query="INSERT INTO `Note` (Name, Contents, Creation_Time, Last_Edit_Time, Id_User) VALUES ('$tytul', '$tresc', '$czasUtworzenia','$czasEdycji',".$_SESSION['Id_User'].")";
mysql_query($query) or die('Error (query)'); 
}
   ?>