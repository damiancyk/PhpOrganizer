
<!-- Poni¿ej znajduje siê sam formularz -->
<form action="?page=documents/calculator.php" method="POST">
<div class='box'>
Podaj dwie liczby:<br /><br/>
Liczba A: <input name="a" /><br />
Liczba B: <input name="b" /><br />
<input type="radio" name="action" value="+" checked="true"/> +  &nbsp&nbsp&nbsp&nbsp&nbsp
<input type="radio" name="action" value="-"/> -&nbsp&nbsp&nbsp&nbsp&nbsp
<input type="radio" name="action" value="*"/> *&nbsp&nbsp&nbsp&nbsp&nbsp
<input type="radio" name="action" value="/"/> /</br>
<input type="submit" name="licz" value="Oblicz!" />
<br/><br/>
<?php result();?>
</div>
</form>

<?php
function result(){
if(isset($_POST['a'])&&isset($_POST['b'])){
switch($_POST['action']){
case '+':$result=$_POST['a']+$_POST['b'];
break;
case '-':$result=$_POST['a']-$_POST['b'];
break;
case '*':$result=$_POST['a']*$_POST['b'];
break;
case '/':
if($_POST['b']==0)$result="blad - dzielenie przez zero";
else $result=$_POST['a']/$_POST['b'];
break;
default:
$result="blad";
break;
}
echo 'wynik dzialania: '.$result;
}
}

?>