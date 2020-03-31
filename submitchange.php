<form class="question" method="get">
	<?php
	require "model.php";
	session_start();
	if ($_SESSION['avtorizcheck']=="YES"){
		$link = mysqli_connect('localhost','root','','questiondb');
		$sql="SELECT * FROM questions where id=".$_SESSION['taskchnga']."";
		$result = mysqli_query($link,$sql);
		$row=$result->fetch_assoc();
		echo '<p>Имя</p><input class="easyout" required type="number" name="id" value='.$row['id'].'><br>';
		echo '<p>Заголовок</p><input  class="easyout"required  type="text" name="gettitle" value='.$row['title'].'><br>';
		echo '<p>Почта</p><input class="easyout" type="email" required name="email" value='.$row['email'].'><br>';
		echo '<p>Содержание</p><input class="easyout" type="text" required name="content" value='.htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8').'><br>';
		echo "<p>Решено</p>	<select name='forcheckup'>
				<option value='no'>Нет</option>
                <option value='yes'>Да</option>
        		</select>";
	if($row['changed']==null){
		echo "<p>Изменено</p><input name='redacted' type='checkbox' disabled value".$row['changed']."><br>";
	}
	else{
		echo "<p>Изменено</p><input name='redacted' type='checkbox' disabled checked value".$row['changed']."><br>";
	}
	}
	else{
		echo("<a href='index.php'>Чтобы изменить данные пройдите авторизацию на главной странице</a>");
	}
	if(isset($_GET['change']) and $_SESSION['avtorizcheck']=="YES"){
		dataupdate($link,$_GET['id'],$_GET['gettitle'],$_SESSION['taskchnga'],"yes",$_GET['content'],$_GET['email'],$_GET['forcheckup']);
	}
	elseif($_SESSION['avtorizcheck']!="YES"){
		echo("<a href='index.php'>Чтобы изменить данные пройдите авторизацию на главной странице</a>");
	}

	?>
	<br>
	<input type="submit" name="change" value="confirm">
</form>