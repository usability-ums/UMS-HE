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
<legend>ADD NEW PROJECT</legend>
<p></p>
<script>
    function docheck(){
        if(document.form.id.value==""){
        alert("Please enter the project name!");
        return false;
        }
	if(document.form.id.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at project name input field.");
        return false;	
	}
        if(document.form.sid.value==""){
        alert("Please enter the sub project name!");
        return false;
        }
	if(document.form.sid.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at sub project name input field.");
        return false;	
	}
    }
</script>
<form name="form" action="hmainproject.php" method="POST" onsubmit="return docheck()">
<table>
<tr>
<td>Project Name</td>
<td>: <input type="text" style="width:60mm" name="id" value=""></td>
</tr>
<tr>
<td>Sub Project Name</td>
<td>: <input type="text" style="width:60mm" name="sid" value=""></td>
</tr>
<tr><td><br/></td><td></td></tr>
<td></td>
<td><input type="submit" name="submit" value="ADD"><td> 
</tr>
</table>
</form>

</fieldset>
</body>
</html>