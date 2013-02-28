 <?php require("./documents/calendar/translation.php"); ?>
 
 <div id="calendar">
	<select id="selectList" onChange="if(this.value != 'none') document.location = this.value;"> 
    <option value="none">Miesiac</option> 
    <option value="?page=documents/event/eventCalendar.php&month=1">styczen</option> 
    <option value="?page=documents/event/eventCalendar.php&month=2">luty</option> 
	<option value="?page=documents/event/eventCalendar.php&month=3">marzec</option> 
	<option value="?page=documents/event/eventCalendar.php&month=4">kwiecien</option> 
	<option value="?page=documents/event/eventCalendar.php&month=5">maj</option> 
	<option value="?page=documents/event/eventCalendar.php&month=6">czerwiec</option> 
	<option value="?page=documents/event/eventCalendar.php&month=7">lipiec</option> 
	<option value="?page=documents/event/eventCalendar.php&month=8">sierpien</option> 
	<option value="?page=documents/event/eventCalendar.php&month=9">wrzesien</option> 
	<option value="?page=documents/event/eventCalendar.php&month=10">pazdziernik</option> 
	<option value="?page=documents/event/eventCalendar.php&month=11">listopad</option> 
	<option value="?page=documents/event/eventCalendar.php&month=12">grudzien</option> 
	</select>
	
	<select id="selectList" onChange="if(this.value != 'none') document.location = this.value;"> 
    <option value="none">Rok</option> 
	<?php
	for($i = 2005; $i < 2020; $i++)
	{
		echo "<option value='?page=documents/event/eventCalendar.php&year=$i'>$i</option>";     
	}
	?>
	</select>

	 <div id='selectList'>
 <a href='?page=documents/event/eventCalendar.php&actualDate=yes'> aktualna data </a>
 </div>
 
<?php
if(!isset($_SESSION['diaryMonth']))$_SESSION['diaryMonth']=$_SESSION['month'];
if(!isset($_SESSION['diaryYear']))$_SESSION['diaryYear']=$_SESSION['year'];
if(isset($_GET['month']))$_SESSION['diaryMonth']=$_GET['month'];
if(isset($_GET['year']))$_SESSION['diaryYear']=$_GET['year'];
if(isset($_GET['actualDate'])){
$_SESSION['diaryYear']=$_SESSION['year'];
$_SESSION['diaryMonth']=$_SESSION['month'];
}
if(isset($_GET['previousMonth']))$_SESSION['diaryMonth']=previousMonth($_SESSION['diaryMonth']);
if(isset($_GET['nextMonth']))$_SESSION['diaryMonth']=nextMonth($_SESSION['diaryMonth']);
if(isset($_GET['previousYear']))$_SESSION['diaryYear']=previousYear($_SESSION['diaryYear']);
if(isset($_GET['nextYear']))$_SESSION['diaryYear']=nextYear($_SESSION['diaryYear']);

showCalendar($_SESSION['diaryMonth'], $_SESSION['diaryYear']);
?>
	
 <?php
 
 function showCalendar($month, $year){
 //This puts the day, month, and year in seperate variables 
 $day = date('d', $_SESSION['date']) ; 
 
 //Here we generate the first day of the month 
 $first_day = mktime(0,0,0,$month, 1, $year) ; 
 
 //This gets us the month name 
 $title = date('F', $first_day) ; 
 $title=polishMonth($month);
 
 $day_of_week = date('D', $first_day) ; 
  
   switch($day_of_week){ 
 case "Sun": $blank = 0; break; 
 case "Mon": $blank = 1; break; 
 case "Tue": $blank = 2; break; 
 case "Wed": $blank = 3; break; 
 case "Thu": $blank = 4; break; 
 case "Fri": $blank = 5; break; 
 case "Sat": $blank = 6; break; 
 }
 
 //We then determine how many days are in the current month
 $days_in_month = cal_days_in_month(0, $month, $year) ; 
 
 $previousMonth=previousMonth($_SESSION['diaryMonth']);
 $nextMonth=nextMonth($_SESSION['diaryMonth']);
 $previousYear=previousYear($_SESSION['diaryYear']);
 $nextYear=nextYear($_SESSION['diaryYear']);
 
 //Here we start building the table heads 
 echo "<table border=1 width=294>";
 echo "<tr><th colspan=7> WYDARZENIA</th>  </tr>";
 echo "<tr><th colspan=1> 
</th>
<th colspan=1>
 <div id='navigation'>
  <a href='?page=documents/event/eventCalendar.php&month=$previousMonth'> < </a>
 </div>
  <div id='navigation'>
  <a href='?page=documents/event/eventCalendar.php&month=$nextMonth'> > </a>
 </div>
</th> 
<th colspan=2> 
$title
 </th>
 
 <th colspan=1>
 $year
 </th>
 <th colspan=1>
 <div id='navigation'>
 <a href='?page=documents/event/eventCalendar.php&year=$previousYear'> < </a>
 </div>
 <div id='navigation'>
 <a href='?page=documents/event/eventCalendar.php&year=$nextYear'> > </a>
 </div>
 </th>
 <th colspan=1>
 
 </th>
 </tr>";
 echo "<tr><td width=42>
 <span class='sunday'>
 ND
 </span>
 </td><td width=42>PN</td><td 
width=42>WT</td><td width=42>SR</td><td width=42>CZ</td><td 
width=42>PT</td>
<td width=42>
 <span class='saturday'>
 S
 </span>
 </td>
</tr>";

 //This counts the days in the week, up to 7
 $day_count = 1;

 echo "<tr>";
 //first we take care of those blank days
 while ( $blank > 0 ) 
 { 
 echo "<td> - </td>"; 
 $blank = $blank-1; 
 $day_count++;
 } 
 
 //sets the first day of the month to 1 
 $day_num = 1;
 
 $noteDays=noteDays($_SESSION['Id_User'], $_SESSION['diaryYear'], $_SESSION['diaryMonth']);
 
 //count up the days, untill we've done all of them in the month
 while ( $day_num <= $days_in_month ) 
 { 
 
 
 echo "<td> <a href='?page=documents/event/oneEvent.php&day=$day_num'>";
 
 if  ($day_num==$day&&$month==$_SESSION['month']&&$year==$_SESSION['year'])echo "<span class='today'>";
 if(checkNoteDay($day_num, $noteDays)) echo "<div id='event'>";

 echo $day_num; 

 if(checkNoteDay($day_num, $noteDays)) echo "</div>"; 
 if  ($day_num==$day&&$month==$_SESSION['month']&&$year==$_SESSION['year'])echo "</span>";
 
 echo "</a> </td>"; 
 
 
 $day_num++; 
 $day_count++;

 //Make sure we start a new row every week
 if ($day_count > 7)
 {
 echo "</tr><tr>";
 $day_count = 1;
 }
 } 
 
  //Finaly we finish out the table with some blank details if needed
 while ( $day_count >1 && $day_count <=7 ) 
 { 
 echo "<td> - </td>"; 
 $day_count++; 
 } 
 echo "</tr></table>"; 
 }
 
 function nextMonth($month){
 if($month <12) return $month+1;
 else return 1;
 }
 
  function previousMonth($month){
 if($month >1) return $month-1;
 else return 12;
 }
 
function nextYear($year){
 return $year+1;
}

function previousYear($year){
 return $year-1;
}

function noteDays($idUser, $year, $month){
$noteDays[]=null;


 $query="SELECT Event.* FROM Event 
 INNER JOIN Event_Team ON Event.Id_Event=Event_Team.Id_Event
 INNER JOIN Team ON Team.Id_Team=Event_Team.Id_Team
 INNER JOIN User_Team ON User_Team.Id_Team=Team.Id_Team
 WHERE User_Team.Id_User=$idUser AND Event.Year=$year AND Event.Month=$month
 ";
 
 $result = mysql_query($query) or die('Error (query)'); 
 $i=0;
  if(mysql_num_rows($result) > 0) { 
    while ($r = mysql_fetch_object($result)) {
$noteDays[$i]=$r->Day;
$i++;
	}
}

return $noteDays;
}

function checkNoteDay($day, $noteDays){
for($i=0;$i<count($noteDays);$i++){
if($day==(int)$noteDays[$i])return true;
}
}
 ?>
 </div>