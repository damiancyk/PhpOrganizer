 <?php

 function polishMonth($englishMonth){
$englishMonth=(int)$englishMonth;
  $month_pl = array(1 => 'styczen', 'luty', 'marzec', 'kwiecien', 'maj', 'czerwiec', 'lipiec', 'sierpien', 'wrzesien', 'pazdziernik', 'listopad', 'grudzien');
 return $month_pl[$englishMonth];
 }
 
  function polishDay($englishDay){
  $day_week_pl = array('Monday' => 'poniedzialek', 'Tuesday' => 'wtorek', 'Wednesday' => 'sroda', 'Thursday' => 'czwartek', 'Friday' => 'piatek', 'Saturday' => 'sobota', 'Sunday' => 'niedziela');
 return  $day_week_pl[$englishDay];
 }
 
 ?>