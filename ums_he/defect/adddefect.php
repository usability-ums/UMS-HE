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
<script>
    function docheck1(){
        if(document.form1.pid.value==""){
        alert("Please select a project name!");
        return false;
        }
    }
</script>
<fieldset>
<legend>ADD DEFECT</legend>
<p></p>
<?php
if($_POST["pid"] =="" && $_POST["pid1"] ==""){
?>
<form name="form1" action="adddefect.php" method="POST" onsubmit="return docheck1()">
<table>
<tr>
<td>Project Name</td>
<td>: <select name="pid" style="width:60mm">
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

} else {}

mysql_close($con);
?>
</select>
</td>
<td>
<input type="submit" name="submit" value="GO">
</td> 
</tr>
</table>
</form>
<?php
}
if($_POST["pid"] !=""){
?>
<script>
    function docheck2(){
        if(document.form2.pid2.value==""){
        alert("Please select a sub project name!");
        return false;
        }
    }
</script>
<form name="form2" action="adddefect.php" method="POST" onsubmit="return docheck2()">
<table>
<tr>
<td>Project Name</td>
<td>: <select name="pid1" style="width:60mm">
<option value="<?php printf("%s",$_POST["pid"]); ?>"><?php printf("%s",$_POST["pid"]); ?></option>
</select>
</td>
</tr>
<tr>
<td>Sub Project Name</td>
<td>: <select name="pid2" style="width:60mm">
<option value=""> - SELECT SUB PROJECT NAME -</option>
<?php
require("../library/connection.php");

$sql = "SELECT subproject FROM dfproject WHERE project='$_POST[pid]'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {
?>
	<option value="<?php printf("%s",$myrow["subproject"]); ?>"><?php printf("%s",$myrow["subproject"]); ?></option>
<?php
} while ($myrow = mysql_fetch_array($result));

} else {}

mysql_close($con);
?>
</select>
</td>
<td>
<input type="submit" name="submit" value="GO">
</td> 
</tr>
</table>
</form>
<?php
}
if($_POST["pid2"] !=""){
?>
<script type="text/javascript" src="../js/formfieldlimiter.js">

/***********************************************
* Form field Limiter v2.0- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Project Page at http://www.dynamicdrive.com for full source code
***********************************************/

</script>
<script>
    function doCheck(){
        if(document.form.is.value==""){
        alert("Please enter the issue!");
        return false;
        }
        if(document.form.rc.value==""){
        alert("Please enter the recommendation!");
        return false;
        }
        if(document.form.sc.value==""){
        alert("Please enter the defect location!");
        return false;
        }
        if(document.form.userfile.value==""){
        alert("Please enter the screenshot!");
        return false;
        }
        if(document.form.env.value==""){
        alert("Please enter the environment!");
        return false;
        }
	var fileName = document.form.userfile.value;
	var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
	if(ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG")
	{
	return true;
	} 
	else
	{
	alert("Upload jpg screenshot only");
	return false;
	}
    }
</script>
<form name="form" action="hadddefect.php" ENCTYPE="multipart/form-data" method="POST" onsubmit="return doCheck()">
<?php
require("../library/connection.php");
$sql = "SELECT * FROM no";
$result = mysql_query($sql,$con);
if ($myrow = mysql_fetch_array($result)){

$format=$myrow["format"];
$no=(int)$myrow["no"]+1;
if(strlen($no)==1){
$no="00000".$no;
}
if(strlen($no)==2){
$no="0000".$no;
}
if(strlen($no)==3){
$no="000".$no;
}
if(strlen($no)==4){
$no="00".$no;
}
if(strlen($no)==5){
$no="0".$no;
}
if(strlen($no)==6){
$no=$no;
}
$id=$format.$no;
$sql="UPDATE no SET no='$no' WHERE format='UR'";
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
?>
<table>
<tr>
<td>Defect No</td>
<td>: <input type="text" style="width:60mm" name="no12" value="<?php printf("%s",$id); ?>" disabled="disabled"></td>
</tr>
<input type="hidden" name="no" value="<?php printf("%s",$id); ?>">
<input type="hidden" name="pj" value="<?php printf("%s",$_POST["pid1"]); ?>">
<input type="hidden" name="spj" value="<?php printf("%s",$_POST["pid2"]); ?>">
<?php
}
?>
<tr>
<td>Project Name</td>
<td>: <input type="text" style="width:60mm" name="pj12" value="<?php printf("%s",$_POST["pid1"]); ?>" disabled="disabled"></td>
</tr>
<tr>
<td>Sub Project Name</td>
<td>: <input type="text" style="width:60mm" name="spj12" value="<?php printf("%s",$_POST["pid2"]); ?>" disabled="disabled"></td>
</tr>
<tr>
<td>Defect Type</td>
<td>: <select name="tp"><option value="Problem Report">Problem Report (PR)</option><option value="Change Request">Change Request (CR)</option></select></td>
</tr>
<tr>
<td>Testing Type</td>
<td>: <select name="ty"><option value="Expert Review">Expert Review (ER)</option><option value="User Experience Test">User Experience Test (UET)</option></select></td>
</tr>
<tr>
<td>Stage of Prototype</td>
<td>: <select name="sp"><option value="Early">Early</option><option value="Intermediate">Intermediate</option><option value="Advance">Advance</option></select></td>
</tr>
<tr>
<td>Stage of SDLC</td>
<td>: <select name="st"><option value="Requirement">Requirement</option><option value="Design">Design</option><option value="System Test">System Test</option></select></td>
</tr>
<tr>
<td>Issue</td>
<td> :&nbsp;<textarea name="is" rows="4" cols="60"></textarea><div id="des-status"></div></td>
</tr>
<tr>
<td>Category</td>
<td>: <select name="ct">
<option value="Compatibility">Compatibility</option>
<option value="Consistency">Consistency</option>
<option value="Error Prevention & Correction">Error Prevention & Correction</option>
<option value="Explicitness">Explicitness</option>
<option value="Flexibility">Flexibility</option>
<option value="Functionality">Functionality</option>
<option value="Informative Feedback">Informative Feedback</option>
<option value="Language & Content">Language & Content</option>
<option value="Navigation">Navigation</option>
<option value="Privacy">Privacy</option>
<option value="User Guidance & Support">User Guidance & Support</option>
<option value="Visual Clarity">Visual Clarity</option>
<option value="Others">Others</option>
</select></td>
</tr>
<tr>
<td>Severity</td>
<td>: <select name="sr"><option value="Minor">Minor</option><option value="Major">Major</option><option value="Critical">Critical</option></select></td>
</tr>
<tr>
<td>Recommendation</td>
<td> :&nbsp;<textarea name="rc" rows="4" cols="60"></textarea><div id="des-status1"></div></td>
</tr>
<tr>
<td>Impact</td>
<td> :&nbsp;<textarea name="im" rows="4" cols="60"></textarea><div id="des-status4"></div></td>
</tr>
<tr>
<td>Defect Location</td>
<td> :&nbsp;<textarea name="sc" rows="4" cols="60"></textarea><div id="des-status2"></div></td>
</tr>
<tr>
<td>Screenshot</td>
<td>: <input type="file" name="userfile"/> .jpg format only</td>
</tr>
<tr>
<td>Environment</td>
<td> :&nbsp;<textarea name="env" rows="4" cols="60"></textarea><div id="des-status3"></div></td>
</tr>
<tr>
<td align="center" colspan="2"><br/><input type="submit" name="submit" value="ADD"><td>
</tr>
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
fieldlimiter.setup({
	thefield: document.form.rc, //reference to form field
	maxlength: 250,
	statusids: ["des-status1"], //id(s) of divs to output characters limit in the form [id1, id2, etc]. If non, set to empty array [].
	onkeypress:function(maxlength, curlength){ //onkeypress event handler
		if (curlength<maxlength) //if limit hasn't been reached
			this.style.border="2px solid gray" //"this" keyword returns form field
		else
			this.style.border="2px solid red"
	}
})
fieldlimiter.setup({
	thefield: document.form.sc, //reference to form field
	maxlength: 250,
	statusids: ["des-status2"], //id(s) of divs to output characters limit in the form [id1, id2, etc]. If non, set to empty array [].
	onkeypress:function(maxlength, curlength){ //onkeypress event handler
		if (curlength<maxlength) //if limit hasn't been reached
			this.style.border="2px solid gray" //"this" keyword returns form field
		else
			this.style.border="2px solid red"
	}
})
fieldlimiter.setup({
	thefield: document.form.env, //reference to form field
	maxlength: 250,
	statusids: ["des-status3"], //id(s) of divs to output characters limit in the form [id1, id2, etc]. If non, set to empty array [].
	onkeypress:function(maxlength, curlength){ //onkeypress event handler
		if (curlength<maxlength) //if limit hasn't been reached
			this.style.border="2px solid gray" //"this" keyword returns form field
		else
			this.style.border="2px solid red"
	}
})
fieldlimiter.setup({
	thefield: document.form.im, //reference to form field
	maxlength: 250,
	statusids: ["des-status4"], //id(s) of divs to output characters limit in the form [id1, id2, etc]. If non, set to empty array [].
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