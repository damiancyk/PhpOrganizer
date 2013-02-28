<?php require("./documents/login/check.php"); ?>

<?php
#tworze zmienne dla sesji
if (!isset($_SESSION['count'])) {
    echo 'nie ma ich w sesji, tworze..';
	$_SESSION['count']=10;
    $_SESSION['offset']=0;
    $_SESSION['sortBy']='Name';
}
?>

<div id="boxMenuContents">
<div id="navigation">
<button id="buttonAction" onclick="window.location.href = '?page=documents/note/addNote.php'">dodaj nonatke</button>
</div>

<div id="anotherOptions">
<?php 
sortBy(); 
?>
</div>

<div id="info">
<?php 
showInfo();
?>
</div>

</div>



<div id="boxMainContents">

<?php 
anotherSide(); 
showData()
?>
</div>

<?php
//sortBy();

function sortBy(){
echo "<form action='?page=documents/note/note.php' method='post'>";

#ustawiam zmienne dla sesji z pol formularza
if (isset($_POST['count']))	$_SESSION['count']=$_POST['count'];
if (isset($_POST['offset']))$_SESSION['offset']=$_SESSION['count']*$_POST['offset'];
if (isset($_POST['sortBy']))$_SESSION['sortBy']=$_POST['sortBy'];

echo 'Sortuj wg:</br>';
echo '<input type="radio" name="sortBy" value="Name"/> Nazwa</br>';
echo '<input type="radio" name="sortBy" value="Creation_Time"/> Czas utworzenia (od najstarszej)</br>';
echo '<input type="radio" name="sortBy" value="Last_Edit_Time"/> Czas modyfikacji (od najstarszej)</br>';

echo 'Rekordow na stronie:</br>';
echo '<input type="radio" name="count" value="5"/> 5</br>';
echo '<input type="radio" name="count" value="10"/> 10</br>';
echo '<input type="radio" name="count" value="30"/> 30</br>';

echo "<input type='submit' id='buttonAction' name='zmien' value='zmien' /> </br></br>";
echo "</form>";
}

function showInfo(){
echo 'rekordow na str: '.$_SESSION['count'].'</br>';
echo 'str: '.$_SESSION['offset']/$_SESSION['count'].'</br>';
echo 'sortowanie wg: <br/>';
switch($_SESSION['sortBy'])
{
   case 'Name':
      echo 'nazwy';                  
      break;
   case 'Creation_Time':
      echo 'czas utworzenia (od najstarszej)';
      break;
   case 'Last_Edit_Time':
      echo 'czas modyfikacji (od najstarszej)';
      break;
   default:
      echo '<error>';      
}
}

function anotherSide(){
echo "<form action='?page=documents/note/note.php' method='post'>";
$sql = "Select count(*) from Note WHERE Id_User=".$_SESSION['Id_User'];
$result = mysql_query($sql);
$r = mysql_fetch_array($result);
$pages = ceil($r[0]/$_SESSION['count']);

for ($i=0; $i<$pages; $i++) {
    if ($i*$_SESSION['count']==$_SESSION['offset']) {
        echo ' '.$i.' ';
    } else {
        echo "<input type='submit'  id='buttonNextPage' name='offset' value='$i' />";
    }
}
echo "</form>";
}

function showData(){
$query="SELECT * FROM `Note` WHERE `Id_User`=".$_SESSION['Id_User']." ORDER BY ".$_SESSION['sortBy']." LIMIT ".$_SESSION['count']." OFFSET ".$_SESSION['offset'];

    $result = mysql_query($query)
        or die('Error (query)');
    if (mysql_num_rows($result) > 0) {
        echo "<table>";
        echo"<tr>
<td> <i><u> .. </i></u></td>
<td> <i><u> Tytul </i></u></td>
<td> <i><u> Tresc </i></u></td>
<td> <i><u> Czas utworzenia </i></u></td>
<td> <i><u> Ostatni Czas edycji </i></u></td>
</tr>";
        
        while ($r = mysql_fetch_object($result)) {
            echo "<tr>".
            "<td>".
            " <form action='?page=documents/note/editNote.php' method='post'> ".
            "<input type='hidden' name='Id_Note' value='$r->Id_Note' />".
            "<input type='submit' id='buttonAction' name='Id_Submit' value='pokaz' /> ".
            "</form>".
            "</td>".
            "<td><b><i>".$r->Name."</b></i></td>".
            "<td>".$r->Contents."</td>".
            "<td>".date('d-m-Y',$r->Creation_Time)."</td>".
            "<td>".date('d-m-Y h:i',$r->Last_Edit_Time)."</td>".
            "</tr>";
        }
        echo "</table> </br>";
    }
	}
?>
