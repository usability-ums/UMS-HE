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

$opass=myAddSlashes($_POST["ow"]);
$npass=myAddSlashes($_POST["pw"]);

$sql = "SELECT * FROM users WHERE email='$_COOKIE[us]' AND password='$opass'";
$result = mysql_query($sql,$con);
if ($myrow = mysql_fetch_array($result)){

$sql="UPDATE users SET password='$npass' WHERE email='$_COOKIE[us]'";
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "<p>Your password has been modified successfully!</p>";

}else{
echo "<p><font color=\"red\">Your old password is incorrect!<br/>Password not change.</font></p>";
}
mysql_close($con)
?> 
</body>
</html>