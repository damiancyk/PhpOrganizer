 <?php require("./documents/calendar/translation.php"); ?>
 

 
 <div id="oneDay">
  <button id="buttonAction" onclick="window.location.href = '?page=documents/diary/diary.php'">< powrot</button>
  <br/>
<?php
if(isset($_GET['day']))$_SESSION['diaryDay']=$_GET['day'];
$data = $_SESSION['diaryYear']."-".$_SESSION['diaryMonth']."-".$_SESSION['diaryDay'];
$dayWeekName = date("l",strtotime($data)); 
$dayWeekName=polishDay($dayWeekName);
$monthName=polishMonth($_SESSION['diaryMonth']);

$miesiac_pl = array(1 => 'stycznia', 'lutego', 'marca', 'kwietnia', 'maja', 'czerwca', 'lipca', 'sierpnia', 'wrzeœnia', 'paŸdziernika', 'listopada', 'grudnia');
$dzien_tyg_pl = array('Monday' => 'poniedzia³ek', 'Tuesday' => 'wtorek', 'Wednesday' => 'œroda', 'Thursday' => 'czwartek', 'Friday' => 'pi¹tek', 'Saturday' => 'sobota', 'Sunday' => 'niedziela');

echo '----------- <br/><h2> ';
echo $_SESSION['diaryDay'].' '.$monthName.', '.$_SESSION['diaryYear'];
echo ' </h2>-------- <br/>';
echo "<h3> $dayWeekName </h3>-----<br/>";

	$query="SELECT `Id_Diary`, `Contents` FROM `Diary` WHERE 
 `Day`=".$_SESSION['diaryDay']." AND `Month`=".$_SESSION['diaryMonth']." AND `Year`=".$_SESSION['diaryYear']." AND `Id_User`=".$_SESSION['Id_User'];
 $result = mysql_query($query) or die('Error (query)'); 
 
 $contents='';
 if(mysql_num_rows($result) > 0) { 
    $r = mysql_fetch_object($result);
	$contents="$r->Contents";
	$_SESSION['diaryNoteExists']=true;
	}else{
	$_SESSION['diaryNoteExists']=false;
	}

echo "<form action='?page=documents/diary/oneDay.php&saveData=1' method='post'> ";
echo "<div class='box'>";
echo '<h1>Wpis na ten dzien</h1>';
echo '<label>';
echo '<span>Wpis :</span>';
echo " <textarea class='message'  name='note'/>";
echo $contents;
echo '</textarea>';
echo '</label>';
echo '<label>';
echo "<input type='submit' class='button' name ='Save' value='Zapisz zmiany' />"; 
echo '</label>';
if(isset($_GET['saveData']))
{
saveData( $_POST['note']);
}
echo '</div>';
echo '</form>';
?>

<?php
function checkNote($year, $month, $day, $idUser){
 $query="SELECT `Id_Diary`, `Contents` FROM `Diary` WHERE 
 `Day`=$day, `Month`=$month, `Year`=$year, `Id_User`=".$_SESSION['Id_User'];
 $result = mysql_query($query) or die('Error (query)');

if(mysql_num_rows($result) > 0)return true;
else return false;
}


function saveData($contents){
echo '<div id ="messageGood">';
if($_SESSION['diaryNoteExists']==true){
if($contents==''){
 $query="DELETE FROM diary WHERE Id_User=".$_SESSION['Id_User']." AND day = ".$_SESSION['diaryDay'].
 " AND month= ".$_SESSION['diaryMonth']." AND year= ".$_SESSION['diaryYear'];
mysql_query($query) or die('Error (queryDelete)'); 
echo 'usunieto wpis';
$_SESSION['diaryNoteExists']=false;
}else{

$zapytanie = "UPDATE `nba` SET `lata` = '14',`punkty` = '125' WHERE `id`='1'";

$query="UPDATE diary SET Contents ='$contents' WHERE Id_User = ".$_SESSION['Id_User']." AND day = ".$_SESSION['diaryDay']." AND month= ".$_SESSION['diaryMonth']." AND year= ".$_SESSION['diaryYear'];
mysql_query($query) or die('Error (queryAdd)'); 
echo 'nadpisano wpis';
}
}else{
if($contents==''){
echo 'nie wykonano akcji';
}else{
$query="INSERT INTO diary (Contents, Day, Month, Year, Id_User) VALUES ('$contents', ".$_SESSION['diaryDay'].", ".$_SESSION['diaryMonth'].", ".$_SESSION['diaryYear'].", ".$_SESSION['Id_User'].")";
mysql_query($query) or die('Error (query)'); 
echo 'dodano nowy wpis';
}
}
echo '</div>';
header('Location: ?page=documents/diary/diary.php');
}
?>
</div>