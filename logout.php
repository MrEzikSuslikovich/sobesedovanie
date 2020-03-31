<?php
function exitsession()
{
	session_start();
	unset($_SESSION['avtorizcheck']);
	unset($_SESSION['surter']);
	unset($_SESSION['keyval']);
	header('Location:http://localhost/test/index.php');
}
exitsession();
?>