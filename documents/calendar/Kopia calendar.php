 <div id="calendar">
 
 <?php
if(!isset($_SESSION['diaryMonth'])) $_SESSION['diaryMonth']=date('m', time());
if(!isset($_SESSION['diaryYear'])) $_SESSION['diaryYear']=date('Y', time());

 //This gets today's date 
 $date =time () ;

 //This puts the day, month, and year in seperate variables 
 $day = date('d', $date) ; 
 $month = date('m', $date) ; 
 $year = date('Y', $date) ;

 //Here we generate the first day of the month 
 $first_day = mktime(0,0,0,$month, 1, $year) ; 
 
 //This gets us the month name 
 $title = date('F', $first_day) ; 
 
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
 
 //Here we start building the table heads 
 echo "<table border=1 width=294>";
 echo "<tr><th colspan=7> $title $year </th></tr>";
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

 //count up the days, untill we've done all of them in the month
 while ( $day_num <= $days_in_month ) 
 { 
 if  ($day_num==$day)
 echo "<td> <a href='?page=documents/day.php&day=$day_num'> <span class='today'>$day_num </span> </a> </td>";
 else echo "<td> <a href='?page=documents/day.php&day=$day_num'> $day_num </a> </td>"; 
 
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
 
 ?>
 </div>