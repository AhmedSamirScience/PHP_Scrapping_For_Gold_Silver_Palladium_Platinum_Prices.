 

<?php 
header('Content-Type: text/html; charset=utf-8');
$db_name="rates";
 
 
$mysql_user = "root";
$mysql_pass = "";
$server_name = "localhost";

mysql_query("SET NAMES 'utf8'"); 
mysql_query('SET CHARACTER SET utf8'); 

$con  = mysqli_connect($server_name,$mysql_user,$mysql_pass, $db_name); 



if (!$con)
{
    echo"<h3>Connection Error. </h3>".mysqli_connect_error(), "<br>", "<br>" ;
}
else 
{
      echo "-Database connection Success. " , "<br>", "<br>" ;
}
$con->set_charset("utf8");
?>