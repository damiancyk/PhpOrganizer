<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Organizer</title>
<meta name="organizer praca magisterska" content="" />
</head>
<body>
<?php  
if(!isset($_SESSION))session_start();  
if(isset($_SESSION['Logged'])) 
{  

session_unset();  
session_destroy();

if (isset($_COOKIE[session_name()]))
setcookie(session_name(), '', time()-42000, '/');

echo "wylogowales sie"; 
header('Location: ../../index.php?LoginAgain=1');

}else{  
echo "logowanie zakonczone niepowodzeniem"; 
}  
?>
</body>
</html>