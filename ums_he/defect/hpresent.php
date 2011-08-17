<?php
/* UMS - Usability Management System
 * Copyright (C) 2011 Soo (soo.st at mimos dot my)
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */
require("../library/duration.php");
setcookie("temp1", "$_POST[hd1]", time()+3);
setcookie("temp2", "$_POST[hd2]", time()+3);
setcookie("temp3", "$_POST[hd3]", time()+3);
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<?php
require("../library/connection.php");

function myAddSlashes($text) {
	if(get_magic_quotes_gpc())
		return $text;
	else
		return addslashes($text);		
}

date_default_timezone_set( 'Asia/Kuala_Lumpur' );
$handle = date('D d-m-Y hisa');
$note=myAddSlashes($_POST["nt"]);

if($_POST[st]=="Rejected"||$_POST[st]=="Duplicate"){
$sql="UPDATE defect SET state='$_POST[st]', scrubbingnote='$note',status='$_POST[st]' WHERE id='$_POST[id]'";
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
}else if($_POST[st]=="Accepted"){
$sql="UPDATE defect SET state='$_POST[st]', scrubbingnote='$note',status='Opened' WHERE id='$_POST[id]'";
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
}else if($_POST[st]=="KIV"){
$sql="UPDATE defect SET state='$_POST[st]', scrubbingnote='$note',status='KIV' WHERE id='$_POST[id]'";
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
}

$ip=$_SERVER['REMOTE_ADDR'];

$sql="INSERT INTO defectlog (id,chgby,action,date,ip)
VALUES
('$_POST[id]','$_COOKIE[us]','$_POST[st]','$handle','$ip')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

?>
<script type="text/javascript">
alert("Defect has been modified successfully!");
document.location.href='present.php'
</script>
<?php
echo "<p>Defect has been \"$_POST[id]\" modified successfully!</p>";

mysql_close($con);
?>
</body>
</html>