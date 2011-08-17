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
<script>
    function docheck1(){
        if(document.form1.pid.value==""){
        alert("Please select a project name!");
        return false;
        }
    }
</script>
<fieldset>
<legend>PRESENT DEFECT</legend>
<p></p>
<?php
if($_POST["pid"] =="" && $_POST["pid1"] =="" && $_COOKIE["temp1"]==""){
?>
<form name="form1" action="present.php" method="POST" onsubmit="return docheck1()">
<table>
<tr>
<td>Project Name</td>
<td>: <select name="pid" style="width:60mm">
<option value=""> - SELECT PROJECT NAME -</option>
<?php
require("../library/connection.php");

$sql = "SELECT DISTINCT project FROM defect";
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
        if(document.form2.pid3.value==""){
        alert("Please select a testing type!");
        return false;
        }
    }
</script>
<form name="form2" action="present.php" method="POST" onsubmit="return docheck2()">
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

$sql = "SELECT DISTINCT subproject FROM defect WHERE project='$_POST[pid]'";
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
</tr>
<tr>
<td>Testing Type</td>
<td>: <select name="pid3" style="width:60mm">
<option value=""> - SELECT TESTING TYPE -</option>
<?php
require("../library/connection.php");

$sql = "SELECT DISTINCT testingtype FROM defect WHERE project='$_POST[pid]'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {
?>
	<option value="<?php printf("%s",$myrow["testingtype"]); ?>"><?php printf("%s",$myrow["testingtype"]); ?></option>
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
<SCRIPT TYPE="text/javascript" SRC="../js/slideshow.js"></SCRIPT>

<SCRIPT TYPE="text/javascript">
ss = new slideshow("ss");
</SCRIPT>

<?php
require("../library/connection.php");
$sql = "SELECT * FROM defect WHERE project='$_POST[pid1]' AND subproject='$_POST[pid2]' AND testingtype='$_POST[pid3]'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

$status = $myrow["status"];
$string = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["issue"]);
$string = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string));
$string1 = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["recommendation"]);
$string1 = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string1));
$string2 = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["screen"]);
$string2 = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string2));
$string3 = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["scrubbingnote"]);
$string3 = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string3));
$string4 = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["impact"]);
$string4 = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string4));
?>
<SCRIPT TYPE="text/javascript">
s = new slide();
s.src =  "uploads/<?php printf("%s",$myrow["file"]);?>";
s.title = "<?php printf("%s - %s",$myrow["id"],$myrow["severity"]); ?>";
s.text = "<b><u>Issue</u></b> - (<?php printf("%s",$status); ?>)<br/>&#149; <?php printf("%s",$string); ?><br/><b><u>Category</u></b><br/>&#149; <?php printf("%s",$myrow["category"]); ?><br/><b><u>Recommendation</u></b><br/>&#149; <?php printf("%s",$string1); ?><br/><b><u>Screen</u></b><br/>&#149; <?php printf("%s",$string2); ?><br/><b><u>Impact</u></b><br/>&#149; <?php printf("%s",$string4); ?><b><br/><u>Remark</u></b><br/>&#149; <?php printf("%s",$string3); ?>";
ss.add_slide(s);
</SCRIPT>
<?php
} while ($myrow = mysql_fetch_array($result));

} else {
	echo "No information."; 
}
?>

<body ONLOAD="ss.restore_position('SS_POSITION');ss.update();"
ONUNLOAD="ss.save_position('SS_POSITION');">
<p></p>
<DIV ID="slideshow">

<FORM ID="ss_form" NAME="ss_form" ACTION="" METHOD="GET">

<DIV ID="ss_controls">
<b>ISSUE</b> # 
<SELECT ID="ss_select" NAME="ss_select" ONCHANGE="ss.goto_slide(this.selectedIndex)">

</SELECT>

<A ID="ss_prev" HREF="javascript:ss.previous()">Previous</A>

<A ID="ss_next" HREF="javascript:ss.next()">Next</A>

</DIV>

<DIV ID="ss_img_div">
<table><tr><td><br/>
<IMG
ID="ss_img" NAME="ss_img" 
STYLE="width:500px;filter:progid:DXImageTransform.Microsoft.Fade();"
ALT=""><br/></td>
<td width="20px"></td>
<td><DIV ID="ss_text"></DIV>

</td></tr></table>

</DIV>

</FORM>

</DIV>

<SCRIPT TYPE="text/javascript">

function config_ss_select() {
  var selectlist = document.ss_form.ss_select;
  selectlist.options.length = 0;
  for (var i = 0; i < ss.slides.length; i++) {
    selectlist.options[i] = new Option();
    selectlist.options[i].text = (i + 1) + '. ' + ss.slides[i].title;
  }
  selectlist.selectedIndex = ss.current;
}

ss.pre_update_hook = function() {
  return;
}

ss.post_update_hook = function() {
  document.ss_form.ss_select.selectedIndex = this.current;
  return;
}

if (document.images) {
  ss.image = document.images.ss_img;
  ss.textid = "ss_text";
  config_ss_select();
  ss.update();
}
</SCRIPT>

<script type="text/javascript" src="../js/formfieldlimiter.js">

/***********************************************
* Form field Limiter v2.0- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Project Page at http://www.dynamicdrive.com for full source code
***********************************************/

</script>
<script>

    function doCheck3(){
        if(document.form.st.value==""){
        alert("Please select a defect status!");
        return false;
        }
    }
</script>
<form name="form" action="hpresent.php" method="POST" onsubmit="return doCheck3()">
<table>
<input type="hidden" name="hd1" value="<?php printf("%s",$_POST["pid1"]); ?>">
<input type="hidden" name="hd2" value="<?php printf("%s",$_POST["pid2"]); ?>">
<input type="hidden" name="hd3" value="<?php printf("%s",$_POST["pid3"]); ?>">
<tr>
<td>Defect ID</td>
<td>: <select name="id" style="width:60mm">
<?php
$sql = "SELECT * FROM defect WHERE project='$_POST[pid1]' AND subproject='$_POST[pid2]' AND testingtype='$_POST[pid3]'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {
?>
<option value="<?php printf("%s",$myrow["id"]); ?>"><?php printf("%s",$myrow["id"]); ?></option>
<?php
} while ($myrow = mysql_fetch_array($result));

} else {}
?>
</select>
</td></tr>
<tr>
<td>Defect Status</td>
<td>: <select name="st" style="width:60mm">
<option value=""> - SELECT DEFECT STATUS -</option>
	<option value="Accepted">Accepted</option>
	<option value="Rejected">Rejected</option>
	<option value="Duplicate">Duplicate</option>
	<option value="KIV">KIV</option>
</select>
</td></tr>
<tr>
<td>Remark</td>
<td> :&nbsp;<textarea name="nt" rows="4" cols="60"></textarea><div id="des-status"></div></td>
</tr>
<tr>
<td align="center" colspan="2"><br/><input type="submit" name="submit" value="UPDATE"><td> 
</tr>
</table>
</form>

<script type="text/javascript">
fieldlimiter.setup({
	thefield: document.form.nt, //reference to form field
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
</fieldset>
</body>
<?php 
}
if($_COOKIE["temp1"] !=""){
?>		
<SCRIPT TYPE="text/javascript" SRC="../js/slideshow.js"></SCRIPT>

<SCRIPT TYPE="text/javascript">
ss = new slideshow("ss");
</SCRIPT>

<?php
require("../library/connection.php");
$sql = "SELECT * FROM defect WHERE project='$_COOKIE[temp1]' AND subproject='$_COOKIE[temp2]' AND testingtype='$_COOKIE[temp3]'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

$status = $myrow["status"];
$string = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["issue"]);
$string = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string));
$string1 = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["recommendation"]);
$string1 = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string1));
$string2 = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["screen"]);
$string2 = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string2));
$string3 = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["scrubbingnote"]);
$string3 = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string3));

?>
<SCRIPT TYPE="text/javascript">
s = new slide();
s.src =  "uploads/<?php printf("%s",$myrow["file"]);?>";
s.title = "<?php printf("%s - %s",$myrow["id"],$myrow["severity"]); ?>";
s.text = "<b><u>Issue</u></b> - (<?php printf("%s",$status); ?>)<br/><?php printf("%s",$string); ?><br/><b><u>Category</u></b><br/><?php printf("%s",$myrow["category"]); ?><br/><b><u>Recommendation</u></b><br/><?php printf("%s",$string1); ?><br/><b><u>Screen</u></b><br/><?php printf("%s",$string1); ?><b><br/><u>Remark</u></b><br/><?php printf("%s",$string3); ?>";
ss.add_slide(s);
</SCRIPT>
<?php
} while ($myrow = mysql_fetch_array($result));

} else {
	echo "No information."; 
}
?>

<body ONLOAD="ss.restore_position('SS_POSITION');ss.update();"
ONUNLOAD="ss.save_position('SS_POSITION');">
<p></p>
<DIV ID="slideshow">

<FORM ID="ss_form" NAME="ss_form" ACTION="" METHOD="GET">

<DIV ID="ss_controls">

<SELECT ID="ss_select" NAME="ss_select" ONCHANGE="ss.goto_slide(this.selectedIndex)">

</SELECT>

<A ID="ss_prev" HREF="javascript:ss.previous()">Previous</A>

<A ID="ss_next" HREF="javascript:ss.next()">Next</A>

</DIV>
<DIV ID="ss_img_div">
<table><tr><td>
<IMG
ID="ss_img" NAME="ss_img" 
STYLE="width:500px;filter:progid:DXImageTransform.Microsoft.Fade();"
ALT=""><br/></td>
<td><DIV ID="ss_text"></DIV>

</td></tr></table>

</DIV>

</FORM>

</DIV>

<SCRIPT TYPE="text/javascript">

function config_ss_select() {
  var selectlist = document.ss_form.ss_select;
  selectlist.options.length = 0;
  for (var i = 0; i < ss.slides.length; i++) {
    selectlist.options[i] = new Option();
    selectlist.options[i].text = (i + 1) + '. ' + ss.slides[i].title;
  }
  selectlist.selectedIndex = ss.current;
}

ss.pre_update_hook = function() {
  return;
}

ss.post_update_hook = function() {
  document.ss_form.ss_select.selectedIndex = this.current;
  return;
}

if (document.images) {
  ss.image = document.images.ss_img;
  ss.textid = "ss_text";
  config_ss_select();
  ss.update();
}
</SCRIPT>

<script type="text/javascript" src="../js/formfieldlimiter.js">

/***********************************************
* Form field Limiter v2.0- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Project Page at http://www.dynamicdrive.com for full source code
***********************************************/

</script>
<script>

    function doCheck3(){
        if(document.form.st.value==""){
        alert("Please select a defect status!");
        return false;
        }
    }
</script>
<form name="form" action="hpresent.php" method="POST" onsubmit="return doCheck3()">
<table>
<input type="hidden" name="hd1" value="<?php printf("%s",$_COOKIE[temp1]); ?>">
<input type="hidden" name="hd2" value="<?php printf("%s",$_COOKIE[temp2]); ?>">
<input type="hidden" name="hd3" value="<?php printf("%s",$_COOKIE[temp3]); ?>">
<tr>
<td>Defect ID</td>
<td>: <select name="id" style="width:60mm">
<?php
$sql = "SELECT * FROM defect WHERE project='$_COOKIE[temp1]' AND subproject='$_COOKIE[temp2]' AND testingtype='$_COOKIE[temp3]'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {
?>
<option value="<?php printf("%s",$myrow[id]); ?>"><?php printf("%s",$myrow[id]); ?></option>
<?php
} while ($myrow = mysql_fetch_array($result));

} else {}
?>
</select>
</td></tr>
<tr>
<td>Defect Status</td>
<td>: <select name="st" style="width:60mm">
<option value=""> - SELECT DEFECT STATUS -</option>
	<option value="Accepted">Accepted</option>
	<option value="Rejected">Rejected</option>
	<option value="Duplicate">Duplicate</option>
	<option value="KIV">KIV</option>
</select>
</td></tr>
<tr>
<td>Remark</td>
<td> :&nbsp;<textarea name="nt" rows="4" cols="60"></textarea><div id="des-status"></div></td>
</tr>
<tr>
<td align="center" colspan="2"><br/><input type="submit" name="submit" value="UPDATE"><td> 
</tr>
</table>
</form>

<script type="text/javascript">
fieldlimiter.setup({
	thefield: document.form.nt, //reference to form field
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
</fieldset>
</body>
<?php 
}
?>
</html>