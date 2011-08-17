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
<legend>ADD NEW USER ACCOUNT</legend>
<p></p>
<script>

    function doCheck(){
        if(document.form.id.value==""){
        alert("Please select a role!");
        return false;
        }
        if(document.form.rl.value==""){
        alert("Please enter the username!");
        return false;
        }
        if(document.form.todo.value==""){
        alert("Please enter the password!");
        return false;
        }
        if(document.form.dp.value==""){
        alert("Please enter the display name!");
        return false;
        }
	if(document.form.rl.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at username input field.");
        return false;
	}
	if(document.form.todo.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at password input field.");
        return false;
	}
	if(document.form.dp.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at display name input field.");
        return false;
	}
    }
</script>
<form name="form" action="hadd_account.php" method="POST" onsubmit="return doCheck()">
<table>
<tr>
<td>Role</td>
<td>: <select name="id">
<option value=""> - SELECT ROLE -</option>
<?php
require("../library/connection.php");
require("../library/numberonly.php");

$sql = "SELECT DISTINCT role FROM top_permission";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

?>
	<option value="<?php printf("%s",$myrow["role"]); ?>"><?php printf("%s",$myrow["role"]); ?></option>
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
<td>Email</td>
<td>: <input type="text" name="rl" style="width:60mm" value=""></td>
</tr>
<tr>
<td>Password</td>
<td>: <input type="password" name="todo" style="width:60mm" value="" ></td>
</tr>
<tr>
<td>Display Name</td>
<td>: <input type="text" name="dp" style="width:60mm" value=""></td>
</tr>
<tr>
<td><br/></td>
<td> </td>
</tr>
<tr>
<td align="center" colspan="2"><input type="submit" name="submit" value="ADD"><td> 
</tr>
</table>
</form>

</fieldset>
</body>
</html>