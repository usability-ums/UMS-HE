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
<legend>Modify Defect</legend>
<p></p>
<?php
if($_GET["prop_id"] !=""){
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
        alert("Please enter the screen appear!");
        return false;
        }
        if(document.form.env.value==""){
        alert("Please enter the environment!");
        return false;
        }
    }
</script>
<form name="form" action="hedit_defect.php" ENCTYPE="multipart/form-data" method="POST" onsubmit="return doCheck()">
<table>
<tr>
<td>Defect No</td>
<td>: <input type="text" style="width:60mm" name="no12" value="<?php printf("%s",$_GET["prop_id"]); ?>" disabled="disabled"></td>
</tr>
<input type="hidden" name="no" value="<?php printf("%s",$_GET[prop_id]); ?>">
<?php
require("../library/connection.php");

$sql = "SELECT * FROM defect WHERE id='$_GET[prop_id]'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
?>
<tr>
<td>Project Name</td>
<td>: <input type="text" style="width:60mm" name="pj12" value="<?php printf("%s",$myrow["project"]); ?>" disabled="disabled"></td>
</tr>
<tr>
<td>Sub Project Name</td>
<td>: <input type="text" style="width:60mm" name="spj12" value="<?php printf("%s",$myrow["subproject"]); ?>" disabled="disabled"></td>
</tr>
<tr>
<td>Defect Type</td>
<td>: <select name="tp">
<?php
if($myrow["defecttype"] =="Change Request"){
?>
<option value="Problem Report">Problem Report (PR)</option>
<option value="Change Request" selected="selected">Change Request (CR)</option>
<?php
}else{
?>
<option value="Problem Report" selected="selected">Problem Report (PR)</option>
<option value="Change Request">Change Request (CR)</option>
<?php
}
?>
</select></td>
</tr>
<tr>
<td>Testing Type</td>
<td>: <select name="ty">
<?php
if($myrow[testingtype] =="Expert Review"){
?>
<option value="Expert Review" selected="selected">Expert Review (ER)</option>
<option value="User Experience Test">User Experience Test (UET)</option>
<?php
}else{
?>
<option value="Expert Review">Expert Review (ER)</option>
<option value="User Experience Test" selected="selected">User Experience Test (UET)</option>
<?php
}
?>
</select></td>
</tr>
<tr>
<td>Stage of Prototype</td>
<td>: <select name="sp">
<?php
if($myrow[stage1] =="Early"){
?>
<option value="Early" selected="selected">Early</option>
<option value="Intermediate">Intermediate</option>
<option value="Advance">Advance</option>
<?php
}else if($myrow[stage1] =="Intermediate"){
?>
<option value="Early">Early</option>
<option value="Intermediate" selected="selected">Intermediate</option>
<option value="Advance">Advance</option>
<?php
}else{
?>
<option value="Early">Early</option>
<option value="Intermediate">Intermediate</option>
<option value="Advance" selected="selected">Advance</option>
<?php
}
?>
</select></td>
</tr>
<tr>
<td>Stage of SDLC</td>
<td>: <select name="st">
<?php
if($myrow[stage2] =="Requirement"){
?>
<option value="Requirement" selected="selected">Requirement</option>
<option value="Design">Design</option>
<option value="System Test">System Test</option>
<?php
}else if($myrow[stage2] =="Design"){
?>
<option value="Requirement">Requirement</option>
<option value="Design" selected="selected">Design</option>
<option value="System Test">System Test</option>
<?php
}else{
?>
<option value="Requirement">Requirement</option>
<option value="Design">Design</option>
<option value="System Test" selected="selected">System Test</option>
<?php
}
?>
</select></td>
</tr>
<tr>
<td>Issue</td>
<td> :&nbsp;<textarea name="is" rows="4" cols="60"><?php printf("%s",$myrow["issue"]); ?></textarea><div id="des-status"></div></td>
</tr>
<tr>
<td>Category</td>
<td>: <select name="ct">
<?php
if($myrow[category] =="Compatibility"){
?>
<option value="Compatibility" selected="selected">Compatibility</option>
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
<?php
}else if($myrow[category] =="Consistency"){
?>
<option value="Compatibility">Compatibility</option>
<option value="Consistency" selected="selected">Consistency</option>
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
<?php
}else if($myrow[category] =="Error Prevention & Correction"){
?>
<option value="Compatibility">Compatibility</option>
<option value="Consistency">Consistency</option>
<option value="Error Prevention & Correction" selected="selected">Error Prevention & Correction</option>
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
<?php
}else if($myrow[category] =="Explicitness"){
?>
<option value="Compatibility">Compatibility</option>
<option value="Consistency">Consistency</option>
<option value="Error Prevention & Correction">Error Prevention & Correction</option>
<option value="Explicitness" selected="selected">Explicitness</option>
<option value="Flexibility">Flexibility</option>
<option value="Functionality">Functionality</option>
<option value="Informative Feedback">Informative Feedback</option>
<option value="Language & Content">Language & Content</option>
<option value="Navigation">Navigation</option>
<option value="Privacy">Privacy</option>
<option value="User Guidance & Support">User Guidance & Support</option>
<option value="Visual Clarity">Visual Clarity</option>
<option value="Others">Others</option>
<?php
}else if($myrow[category] =="Flexibility"){
?>
<option value="Compatibility">Compatibility</option>
<option value="Consistency">Consistency</option>
<option value="Error Prevention & Correction">Error Prevention & Correction</option>
<option value="Explicitness">Explicitness</option>
<option value="Flexibility" selected="selected">Flexibility</option>
<option value="Functionality">Functionality</option>
<option value="Informative Feedback">Informative Feedback</option>
<option value="Language & Content">Language & Content</option>
<option value="Navigation">Navigation</option>
<option value="Privacy">Privacy</option>
<option value="User Guidance & Support">User Guidance & Support</option>
<option value="Visual Clarity">Visual Clarity</option>
<option value="Others">Others</option>
<?php
}else if($myrow[category] =="Functionality"){
?>
<option value="Compatibility">Compatibility</option>
<option value="Consistency">Consistency</option>
<option value="Error Prevention & Correction">Error Prevention & Correction</option>
<option value="Explicitness">Explicitness</option>
<option value="Flexibility">Flexibility</option>
<option value="Functionality" selected="selected">Functionality</option>
<option value="Informative Feedback">Informative Feedback</option>
<option value="Language & Content">Language & Content</option>
<option value="Navigation">Navigation</option>
<option value="Privacy">Privacy</option>
<option value="User Guidance & Support">User Guidance & Support</option>
<option value="Visual Clarity">Visual Clarity</option>
<option value="Others">Others</option>
<?php
}else if($myrow[category] =="Informative Feedback"){
?>
<option value="Compatibility">Compatibility</option>
<option value="Consistency">Consistency</option>
<option value="Error Prevention & Correction">Error Prevention & Correction</option>
<option value="Explicitness">Explicitness</option>
<option value="Flexibility">Flexibility</option>
<option value="Functionality">Functionality</option>
<option value="Informative Feedback" selected="selected">Informative Feedback</option>
<option value="Language & Content">Language & Content</option>
<option value="Navigation">Navigation</option>
<option value="Privacy">Privacy</option>
<option value="User Guidance & Support">User Guidance & Support</option>
<option value="Visual Clarity">Visual Clarity</option>
<option value="Others">Others</option>
<?php
}else if($myrow[category] =="Language & Content"){
?>
<option value="Compatibility">Compatibility</option>
<option value="Consistency">Consistency</option>
<option value="Error Prevention & Correction">Error Prevention & Correction</option>
<option value="Explicitness">Explicitness</option>
<option value="Flexibility">Flexibility</option>
<option value="Functionality">Functionality</option>
<option value="Informative Feedback">Informative Feedback</option>
<option value="Language & Content" selected="selected">Language & Content</option>
<option value="Navigation">Navigation</option>
<option value="Privacy">Privacy</option>
<option value="User Guidance & Support">User Guidance & Support</option>
<option value="Visual Clarity">Visual Clarity</option>
<option value="Others">Others</option>
<?php
}else if($myrow[category] =="Navigation"){
?>
<option value="Compatibility">Compatibility</option>
<option value="Consistency">Consistency</option>
<option value="Error Prevention & Correction">Error Prevention & Correction</option>
<option value="Explicitness">Explicitness</option>
<option value="Flexibility">Flexibility</option>
<option value="Functionality">Functionality</option>
<option value="Informative Feedback">Informative Feedback</option>
<option value="Language & Content">Language & Content</option>
<option value="Navigation" selected="selected">Navigation</option>
<option value="Privacy">Privacy</option>
<option value="User Guidance & Support">User Guidance & Support</option>
<option value="Visual Clarity">Visual Clarity</option>
<option value="Others">Others</option>
<?php
}else if($myrow[category] =="Privacy"){
?>
<option value="Compatibility">Compatibility</option>
<option value="Consistency">Consistency</option>
<option value="Error Prevention & Correction">Error Prevention & Correction</option>
<option value="Explicitness">Explicitness</option>
<option value="Flexibility">Flexibility</option>
<option value="Functionality">Functionality</option>
<option value="Informative Feedback">Informative Feedback</option>
<option value="Language & Content">Language & Content</option>
<option value="Navigation">Navigation</option>
<option value="Privacy" selected="selected">Privacy</option>
<option value="User Guidance & Support">User Guidance & Support</option>
<option value="Visual Clarity">Visual Clarity</option>
<option value="Others">Others</option>
<?php
}else if($myrow[category] =="User Guidance & Support"){
?>
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
<option value="User Guidance & Support" selected="selected">User Guidance & Support</option>
<option value="Visual Clarity">Visual Clarity</option>
<option value="Others">Others</option>
<?php
}else if($myrow[category] =="Visual Clarity"){
?>
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
<option value="Visual Clarity" selected="selected">Visual Clarity</option>
<option value="Others">Others</option>
<?php
}else{
?>
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
<option value="Others" selected="selected">Others</option>
<?php
}
?>
</select></td>
</tr>
<tr>
<td>Severity</td>
<td>: <select name="sr">
<?php
if($myrow[severity] =="Minor"){
?>
<option value="Minor" selected="selected">Minor</option>
<option value="Major">Major</option>
<option value="Critical">Critical</option>
<?php
}else if($myrow[severity] =="Major"){
?>
<option value="Minor">Minor</option>
<option value="Major" selected="selected">Major</option>
<option value="Critical">Critical</option>
<?php
}else{
?>
<option value="Minor">Minor</option>
<option value="Major">Major</option>
<option value="Critical" selected="selected">Critical</option>
<?php
}
?>
</select></td>
</tr>
<tr>
<td>Recommendation</td>
<td> :&nbsp;<textarea name="rc" rows="4" cols="60"><?php printf("%s",$myrow["recommendation"]); ?></textarea><div id="des-status1"></div></td>
</tr>
<tr>
<td>Impact</td>
<td> :&nbsp;<textarea name="im" rows="4" cols="60"><?php printf("%s",$myrow["impact"]); ?></textarea><div id="des-status4"></div></td>
</tr>
<tr>
<td>Screen Appear</td>
<td> :&nbsp;<textarea name="sc" rows="4" cols="60"><?php printf("%s",$myrow["screen"]); ?></textarea><div id="des-status2"></div></td>
</tr>
<tr>
<td>Screenshot</td>
<td>: <input type="file" name="userfile"/> .jpg format only (only upload if you wish to change the images)</td>
</tr>
<tr>
<td>Environment</td>
<td> :&nbsp;<textarea name="env" rows="4" cols="60"><?php printf("%s",$myrow["environment"]); ?></textarea><div id="des-status3"></div></td>
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