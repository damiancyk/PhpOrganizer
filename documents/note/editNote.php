<?php require("./documents/login/check.php"); ?>

<?
echo "<input type='button' id='buttonAction' onclick=\"parent.location.href='?page=documents/note/note.php'\" value='Powrot'>";
echo "<input type='button' id='buttonAction' onclick=\"parent.location.href='?page=documents/note/editNote.php&askDel=1'\" value='Usun notatke'>";
askDel();

echo "<form action='?page=documents/note/editNote.php' method='post'> ";
echo "<div class='box'>";
if(isset($_POST['Id_Note'])){
	$_SESSION['Id_Note']=$_POST['Id_Note'];
}


 $query='SELECT `Name`, `Contents`, `Creation_Time` FROM `Note` WHERE `Id_Note`='.$_SESSION['Id_Note'];
 $wynik = mysql_query($query) or die('Error (query)'); 
 
 if(mysql_num_rows($wynik) > 0) { 
    $r = mysql_fetch_object($wynik);
	$Name="$r->Name";
	$Contents="$r->Contents";
	$CreationTime="$r->Creation_Time";
?>

<h1>NOTATKA</h1>
<label>
<span>Temat :</span>
<?
echo "<input type='text' class='inputSimple' name='Name' value='$Name' />";
?>
</label>
<label>
<span>Wiadomosc :</span>
<?
    echo "<textarea class='message'  name='Contents'>";
	echo "$r->Contents";
?>
</textarea>
<input type="submit" class="button" name ="Save" value="Save" /> 
</label>

<!--jesli nie pobrano zadnego rekordu-->
<?
}else{
echo 'nic do wyswietlenia';
} 
saveData()
?>

 <?php
 function saveData(){
if(isset($_POST['Name'])&&isset($_POST['Contents']))
{
$Name=$_POST['Name'];
$Contents=$_POST['Contents'];
$czasUtworzenia=date('U');
$czasEdycji=date('U');

if($Name!=''&&$Contents!=''){
$link = mysql_connect('localhost','root','');
mysql_select_db('db_organizer',$link);
addNote($Name, $Contents, $czasUtworzenia, $czasEdycji);
echo '<div id="messageGood"> !!pomyslnie zmodyfikowales dane!! </div>';
}else{
echo ' <div id="messageBad"> !!uzupelnij prawidlowo wszystkie pola!! </div>';
}
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
   
<?php
function askDel(){
if(isset($_GET['askDel'])){
echo '>>';
echo "<input type='button' id='buttonAction' onclick=\"parent.location.href='?page=documents/note/editNote.php&delYes=1'\" value='TAK'>";
echo "<input type='button' id='buttonAction' onclick=\"parent.location.href='?page=documents/note/editNote.php'\" value='NIE'>";
}
if(isset($_GET['delYes'])){
 $link = mysql_connect('localhost','root','');
 mysql_select_db('db_organizer',$link);
 $query="DELETE FROM note WHERE Id_Note=".$_SESSION['Id_Note'];
mysql_query($query) or die('Error (queryDelete)'); 
header('Location: ?page=documents/note/note.php');
}
}
?>
