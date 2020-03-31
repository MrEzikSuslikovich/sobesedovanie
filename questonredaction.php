<form method="post">
<?php
    $link = mysqli_connect('localhost','root','','questiondb');
    $sql="SELECT * FROM questions order by id ";
    $i=0;
    echo "<table border='1' width='100%' cellpadding='3'>
   <tr>
    <th>Id</th>
    <th>title</th>
    <th>email</th>
    <th>content</th>
    <th>checked</th>
    <th>changed</th>
    <th>redact</th>
   </tr>";
    if (mysqli_multi_query($link,$sql)){
        do {
        if ($result = mysqli_store_result($link)) {
            while ($row = mysqli_fetch_row($result)){
                echo "<tr><th>".$row[0]."</th><th>".$row[1]."</th><th>".$row[2]."</th><th>".htmlspecialchars($row[3], ENT_QUOTES, 'UTF-8')."</th><th>".$row[4]."</th><th>".$row[5]."</th><th>"."<input type='submit' name='chanbut' value=$row[0]>"."</th></tr>";
                $i++;
            }
            mysqli_free_result($result);
        }
    } while (mysqli_next_result($link));
    }
    echo "</table>";
?>
</form>
