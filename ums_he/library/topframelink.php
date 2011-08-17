<?php
require("../library/duration.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css" />
<body>
<table width="100%" style="background-color:dodgerblue">
<tr><td style="padding-left: 10px"><font color="grey">
<?php
require("connection.php");
$sql = "SELECT * FROM top_permission WHERE role='$_COOKIE[rl]'";
$result = mysql_query($sql,$con);
if ($myrow = mysql_fetch_array($result)){
if($myrow["home"]=="yes"){
?>
<a href="../link/home.php" target="link"><font color="white"><b>Home</b></font></a> |
<?php
}
if($myrow["project"]=="yes"){
?>
<a href="../link/project.php" target="link"><font color="white"><b>Project</b></font></a> |
<?php
}
if($myrow["defect"]=="yes"){
if($_COOKIE["rl"]=="developer"){
?>
<a href="../link/ddefect.php" target="link"><b><font color="white">Defect</b></font></a> |
<?php
}else{
?>
<a href="../link/defect.php" target="link"><b><font color="white">Defect</b></font></a> |
<?php
}}
if($myrow["account"]=="yes"){
?>
<a href="../link/account.php" target="link"><font color="white"><b>Account</b></font></a> |
<?php
}
if($myrow["report"]=="yes"){
?>
<a href="../link/report.php" target="link"><font color="white"><b>Report</b></font></a> |
<?php
}
if($myrow["audit"]=="yes"){
?>
<a href="../link/audit.php" target="link"><font color="white"><b>Audit</b></font></a> |
<?php
}}
?>
</table>
</body>
</html>