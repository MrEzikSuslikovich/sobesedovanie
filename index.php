<?php

session_start();
include "model.php";

?>	
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="tab">
  <button class="tablinks" onclick="opentab(event, 'questionstab')" id="defaultOpen">Вопросы</button>
  <button class="tablinks" onclick="opentab(event, 'addquestionstab')" id="addq">Добавить вопрос</button>
  <button class="tablinks" onclick="opentab(event, 'setquestionstab')" id="serq" >Изменить вопросы</button>
  </form>
</div>
</form>
<div id="questionstab" class="tabcontent">
	<form method="get">

			<select name="sortsel">
                <option value=id>id</option>
                <option value=email>email</option>
                <option value=title>title</option>
                <option value=сontent>content</option>
                <option value=status>status</option>
                <option value=changed>changed</option>
        </select>

        <select name="updown">
        	<option value="">По возрастанию</option>
        	<option value="DESC">По убыванию</option>
        </select>

    <button type="submit" name="subbut">Buttton</button>
    
  <?php
    pagination($link,'page'); 
    if(isset($_GET['page'])){
 		getsort($link,$_SESSION['sorter'],$_SESSION['keyval'],$_GET['page']);
 	  }
 	  if(isset($_GET['subbut'])){
 		howsortget($_GET['sortsel'],$_GET['updown']);
 		getsort($link,$_SESSION['sorter'],$_SESSION['keyval'],1);
 	  }
    elseif(empty($_SESSION['sorter']) or empty($_GET['page'])){
    howsortget('id','');
    getsort($link,$_SESSION['sorter'],$_SESSION['keyval'],1);
    }
  ?>
</form>
</div>
<div id="addquestionstab" class="tabcontent">
	<form class="question" action='danataan.php'method="post">
	<b>Имя <input type="text" name="title" autocomplete="off" required></b><p name="titlecheck"></p>
	<b>email <input type="email" name="email" autocomplete="off" required></b>
	<p>Текст<textarea name="content" required=""></textarea></p>
	<button type="submit" name="addingauestionbut">Добавить вопрос </button>
	</form>
</div>

<div id="setquestionstab" class="tabcontent">
  <?php
   if(empty($_SESSION['avtorizcheck'])) {
     echo("<a href='avtorization.php'>Logout</a>");
   }
   elseif($_SESSION['avtorizcheck']=="YES"){
    echo("<a href='logout.php'>Logout</a>");
    require "questonredaction.php";
   }
?>
</div>
<script>
function opentab(evt, tabname) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabname).style.display = "block";
  evt.currentTarget.className += " active";
}
document.getElementById("defaultOpen").click();
</script>
</body>
</html>