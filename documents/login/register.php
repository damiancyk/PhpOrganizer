<div id="boxHelloRegister">
Wyglada na to, ze nie posiadasz wlasnego konta.
</br> Wypelnij wiec ponizsze pola wlasnymi danymi
</br> i zarejestruj wlasne konto w wirtualnym organizerze pracy : )
</div>

<form action="?page=register.php&sendData=yes" method="post"> 
<div class="box">
<h1>Rejestracja</h1>

<label>
<span>Login :</span>
<input type="text" class="input" name="Login"/>
</br></br>
<span>Haslo :</span>
<input type="password" class="input" name="Password"/>
</br></br>
<span>Powtorz haslo :</span>
<input type="password" class="input" name="PasswordRepeat"/>
</label>
<label>
<span>Imie :</span>
<input type="text" class="input" name="Firstname"/>
</br></br>
<span>Nazwisko :</span>
<input type="text" class="input" name="Lastname"/>
</br></br>
<span>Email :</span>
<input type="text" class="input" name="Email"/>
</label>
<label>

<input type="submit" class="button" value="Ok" /> 
</label>
<?php
if(isset($_GET['sendData'])){
$login=trim($_POST['Login']);
$password=trim($_POST['Password']);
$passwordRepeat=trim($_POST['PasswordRepeat']);
$firstname=trim($_POST['Firstname']);
$lastname=trim($_POST['Lastname']);
$email=trim($_POST['Email']);

if($login!=''&&$password!=''&&$passwordRepeat!=''&&$firstname!=''&&$lastname!=''&&$email!=''){
if($password==$passwordRepeat){
if(preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)){
$link = mysql_connect('localhost','root','');
mysql_select_db('db_organizer',$link);
$query="SELECT Login from Login WHERE Login='".$login."'";
$result = mysql_query( $query )
or die('Error (query) >> nie moge wyszukac takiego loginu </br>');
if (mysql_num_rows($result) > 0){
echo 'uzytkownik o takim loginie juz istnieje, wymysl inny login </br>';
}else{
registerUser($firstname, $lastname, $email, $login, $password);
}
}else{
echo 'Wprowadzony email jest nieprawidlowy! </br>';
}
}else{
echo 'Podales dwa rozne hasla! </br>';
}
}else{
echo 'Wymagane wszystkie pola! </br>';
unset($_GET['sendData']);
}
}//getData
?>

<?php
function registerUser($firstname, $lastname, $email, $login, $password){
$link = mysql_connect('localhost','root','');
mysql_select_db('db_organizer',$link);

$query="INSERT INTO User (Firstname, Lastname, Email) VALUES 
('$firstname', '$lastname', '$email')";
mysql_query($query)
or die('Error (query) >> nie moge wstawic podstawowych danych </br>');

$query2="SELECT Id_User from User WHERE 
Firstname='".$firstname."' AND Lastname='".$lastname."' AND Email='".$email."'";
$register_result = mysql_query( $query2 )
or die('Error (query) >> nie moge znalezc ID nowo utworzonego uzytkownika </br>');
$id_User=mysql_fetch_array($register_result, MYSQL_NUM);

$query3="INSERT INTO Login values( '".$login."',SHA1('".$password."'),".$id_User[0].")";
mysql_query( $query3 )
or die('Error (query) >> nie moge wstawic loginu i hasla dla nowo utworzonego uzytkownika </br>');
echo '<div id="messageBad">Rejestracja przebiegla prawidlowo!</div>';	
}
?>
</div>
</form>