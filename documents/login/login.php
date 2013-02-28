<form action="?page=documents/login/login.php&sendData=yes" method="post"> 
<div class="box">
<h1>Logowanie</h1>

<label>
<span>Login :</span>
<input type="text" class="input" name="Login"/>
</label>
<label>
<span>Haslo :</span>
<input type="password" class="input" name="Password"/>
<input type="submit" class="button" value="Ok" /> 
</label>
<label>
</br></br>
<div id="boxHelloRegister">
Witaj! 
</br> Jesli posiadasz juz konto na naszym serwisie, 
</br> zaloguj sie
</br>aby cieszyc sie z wirtualnego organizera pracy : )
</div>
</label>
<?php session_start();
if(isset($_GET['sendData']))
{
$Login=trim($_POST['Login']);
$Password=trim($_POST['Password']);

if($Login!=''&&$Password!=''){

$link = mysql_connect('localhost','root','');
mysql_select_db('db_organizer',$link);

$query = "SELECT Id_User FROM Login WHERE Login='".$Login."' and Password=SHA1('".$Password."')";
$result = mysql_query($query)or die('Error (query)');
	if (mysql_num_rows($result) > 0) {
	$id=mysql_Fetch_array($result, MYSQL_NUM);
	$_SESSION['Id_User']=$id[0];
	$_SESSION['Logged']=1;
	header('Location: ../../index.php');
	}else{
	echo 'Nie ma takiego uzytkownika. Popraw dane!';
	}
}else{
echo 'Wpisz swoj login i haslo!';
}
}

?>
</div>
</form>

