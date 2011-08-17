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
<legend>VERIFICATION</legend>
<p></p>
<?php
if($_GET["prop_id"] !=""){
?>
<script type="text/javascript" src="../Third Party/Character Limit Validation/formfieldlimiter.js">

/***********************************************
* Form field Limiter v2.0- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Project Page at http://www.dynamicdrive.com for full source code
***********************************************/

</script>
<script>
    function doCheck(){
        if(document.form.is.value==""){
        alert("Please enter developer notes!");
        return false;
        }
        if(document.form.tp.value==""){
        alert("Please select a state!");
        return false;
        }
    }
</script>
<form name="form" action="hverify.php" method="POST" onsubmit="return doCheck()">
<table>
<?php
require("../library/connection.php");

$sql = "SELECT * FROM defect WHERE id='$_GET[prop_id]'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
?>
<tr>
<td>Defect No</td>
<td>: <input type="text" style="width:60mm" name="no12" value="<?php printf("%s - %s",$_GET["prop_id"],$myrow["status"]); ?>" disabled="disabled"></td>
</tr>
<input type="hidden" name="no" value="<?php printf("%s",$_GET[prop_id]); ?>">
<tr>
<td>Project Name</td>
<td>: <input type="text" style="width:60mm" name="pj12" value="<?php printf("%s",$myrow["project"]); ?>" disabled="disabled"></td>
</tr>
<tr>
<td>Sub Project Name</td>
<td>: <input type="text" style="width:60mm" name="spj12" value="<?php printf("%s",$myrow["subproject"]); ?>" disabled="disabled"></td>
</tr>
<tr>
<td>State</td>
<td>: <select name="tp">
<option value="">- SELECT STATE -</option>
<option value="Closed">Pass</option>
<option value="Opened">Fail</option>
</select></td>
</tr>
<tr>
<td>Verify Notes</td>
<td> :&nbsp;<textarea name="is" rows="4" cols="60"></textarea><div id="des-status"></div></td>
</tr>
<tr>
<td align="center" colspan="2"><br/><input type="button" value="BACK" onclick="history.go(-1)"><input type="submit" name="submit" value="UPDATE"><td> 
</tr>
<?php
} else {}

mysql_close($con);
?>
</table>
</form>

<script type="text/javascript">
fieldlimiter.setup({
	thefield: document.form.is, //reference to form field
	maxlength: 250,
	statusids: ["des-status"], //id(s) of divs to output characters limit in the form [id1, id2, etc]. If non, set to empty array [].
	onkeypress:function(maxlength, curlength){ //onkeypress event handler
		if (curlength<maxlength) //if limit hasn't been reached
			this.style.border="2px solid gray" //"this" keyword returns form field
		else
			this.style.border="2px solid red"
	}
})
</script>
<?php
}
?>
</fieldset>
</body>
</html>