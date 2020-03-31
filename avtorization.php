<form method='post'>
		<b>Имя <input type='text' name='login' autocomplete='off' required=''></b>
		<b>Пароль <input type='password' name='pass' autocomplete='off' required=''></b>
		<button type='submi' name='avtbut'>Подвтердить</button>
		
</form>
<?php
session_start();
unset($_SESSION['avtorizcheck']);
function avtorization($login,$pass)
{	
	$link = mysqli_connect('localhost','root','','questiondb');
	$sql="SELECT * FROM avtorization where login='$login'";
	$result=mysqli_query($link,$sql);
	$row=mysqli_fetch_row($result);
	if(empty($row[0])){
		echo "Неверный логин";
	}
	else{
		if($row[1]!=$pass){
			echo "Неверный пароль";
		}
		else{
			$_SESSION['avtorizcheck']='YES';
			header('Location:http://localhost/test/index.php');
		}
	}
}
if (isset($_POST['avtbut'])) {
	avtorization($_POST['login'],$_POST['pass']);
}
?>
