<?php
if($_POST["username"]==NULL){
?>
<script type="text/javascript">
alert("Please enter username and password.");
document.location.href='index.php'
</script>
<?php
}

require("ums_he/library/connection.php");

$sql = "SELECT * FROM users WHERE email='$_POST[username]' AND password='$_POST[password]'";
$result = mysql_query($sql,$con);
if ($myrow = mysql_fetch_array($result)){

setcookie("us", "$_POST[username]", time()+21600);
setcookie("rl", "$myrow[role]", time()+21600);
setcookie("un", "$myrow[name]", time()+21600);

date_default_timezone_set( 'Asia/Kuala_Lumpur' );
$handle = date('D d-m-Y hisa');
$ip=$_SERVER['REMOTE_ADDR'];

$sql="INSERT INTO accesslog (name,action,date,ip)
VALUES
('$_POST[username]','login','$handle','$ip')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

?>
<html>
<head>
<title>Usability Management System (UMS)</title>
</head>
	<frameset rows="7%,4%,*,1%,3%" border="0">
		<frame src="ums_he/library/topframe.php" marginheight="1" scrolling="no" noresize="noresize"/>
		<frame src="ums_he/library/topframelink.php" marginheight="1" scrolling="no" noresize="noresize"/>
	      <frameset cols="0.3%,18%,*">
		<frame scrolling="no" noresize="noresize"/>
		<frame src="ums_he/link/home.php" name="link" noresize="noresize" scrolling="no"/>	   
		<frame src="ums_he/home/explain_heuristic.php" name="home" noresize="noresize"/>
	      </frameset>
	<frame src="" marginheight="0" scrolling="no" noresize="noresize"/>
	<frame src="ums_he/library/bottomframe.php" marginheight="0" scrolling="no" noresize="noresize"/>
	</frameset>
</html>
<?php

}else{

?>
<script type="text/javascript">
alert("Username or password wrong, please try again.");
document.location.href='index.php'
</script>
<?php
}
?>