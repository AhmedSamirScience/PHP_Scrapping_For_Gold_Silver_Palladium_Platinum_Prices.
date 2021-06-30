<?php
#region Variables
$DataBase_Name="mahmouda_Palladium";
$Mysql_UserName = "mahmouda_User_PD";
$Mysql_Password = "?dPmSQ4a]GH#k:";
$Host_Name = "gator3176";
#endregion

#region Code of Connection
$Connection  = mysqli_connect($Host_Name ,$Mysql_UserName ,$Mysql_Password ,$DataBase_Name);
if (!$Connection)
{
  echo '<h2 style ="color:red;"> Connection Error.</h2>'.mysqli_connect_error() ;
}
else
{
  echo '<h3 style ="color:#00FF00;">-Database connection Success. </h3>'  ;
}
#endregion

#region Edit for Arabic language
$Connection->set_charset("utf8");
#endregion
?>
