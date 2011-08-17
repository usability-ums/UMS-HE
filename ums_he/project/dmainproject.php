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
<fieldset>
<legend>DELETE PROJECT</legend>
<p></p>
<script>
    function docheck(){
        if(document.form.id.value==""){
        alert("Please select a project name!");
        return false;
        }
	if(document.form.soid.value==""){
        alert("Please enter the security code!");
        return false;
        }
	if(document.form.soid.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at security code input field.");
        return false;	
	}
        if(document.form.soid.value!="Administrator"){
        alert("Incorrect security code!");
        return false;
        }
    }
</script>
<form name="form" action="hdmainproject.php" method="POST" onsubmit="return docheck()">
<table>
<tr>
<td>Project Name</td><td> :
<select name="id" style="width:60mm">
<option value=""> - SELECT PROJECT NAME -</option>
<?php
require("../library/connection.php");
$sql = "SELECT DISTINCT project FROM dfproject";
$result = mysql_query($sql,$con);
if ($myrow = mysql_fetch_array($result)){
do {
?>
	<option value="<?php printf("%s",$myrow["project"]); ?>"><?php printf("%s",$myrow["project"]); ?></option>
<?php
} while ($myrow = mysql_fetch_array($result));

} else {
	echo "No information."; 
}
mysql_close($con);
?>
</select>
</td>
</tr>
<tr>
<td>Security Code</td>
<td>: <input type="password" style="width:60mm" name="soid" value=""></td>
</tr>
<tr>
<tr><td><br/></td><td></td></tr>
<tr>
<td></td>
<td style="padding-left:20px"><input type="submit" name="submit" onClick="return confirm('Are you sure you want to delete this project?')" value="DELETE"><td> 
</tr>
</table>
</form>

</fieldset>
</body>
</html>
