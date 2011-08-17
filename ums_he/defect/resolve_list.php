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
<head>
		<style type="text/css" title="currentStyle">
			@import "../style/demo_table.css";
		</style>
		<script type="text/javascript" language="javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="../js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			jQuery.fn.dataTableExt.aTypes.push(
				function ( sData ) {
					return 'html';
				}
			);
			
			$(document).ready(function() {
				$('#example').dataTable();
			} );
		</script>
</head>
<body id="dt_example">
<fieldset>
<legend>RESOLVE DEFECT</legend>
<?php
if($_POST["pid"] ==""){
?>
<p></p>
<form name="form1" action="resolve_list.php" method="POST" onsubmit="return docheck1()">
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

} else {

}

mysql_close($con);
?>

</select>
</td>
<td>
<input type="submit" name="submit" value="GO">
</td> 
</tr>
</table>
<?php
}
if($_POST["pid"] !=""){
?>		
<p><b>Project : <?php printf("%s",$_POST["pid"]); ?></b></p>
			<div id="demo">
<table cellpadding="0" cellspacing="0" border="1" class="display" id="example">
	<thead>
		<tr align="left">
			<th>Defect No</th>
			<th>Issue</th>
			<th>Recommendation</th>
			<th>Impact</th>
			<th>Severity</th>
			<th>Originator</th>
			<th>State</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
require("../library/connection.php");

$sql = "SELECT * FROM defect WHERE project='$_POST[pid]'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {
$string1 = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["issue"]);
$string1 = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string1));
$string2 = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["recommendation"]);
$string2 = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string2));
$string3 = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["impact"]);
$string3 = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string3));
$string4 = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["raiseby"]);
$string4 = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string4));
?>
	<tr>
	<td><a href="uploads/<?php printf("%s",$myrow["file"]); ?>" target="_blank"><?php printf("%s",$myrow["id"]); ?></a></td>
	<td><?php printf("%s",$string1); ?></td>
	<td><?php printf("%s",$string2); ?></td>
	<td><?php printf("%s",$string3); ?></td>
	<td><?php printf("%s",$myrow["severity"]); ?></td>
	<td><?php printf("%s",$string4); ?></td>
	<td><?php printf("%s",$myrow["status"]); ?></td>
<?php
if($myrow["status"]=="Opened"||$myrow["status"]=="Postponed"){
?>
	<td><a href="resolve.php?prop_id=<?php printf("%s",$myrow["id"]); ?>" target="home">Resolve</a></td>	
<?php
}else{
?>
	<td><img src="../images/denied.gif" width="20px" height="20px"/></td>
<?php
}
?>	

</tr>
<?php
} while ($myrow = mysql_fetch_array($result));

} else {
	echo "No information."; 
}
?>		
</table>
</div>
<?php
}
?>
</fieldset>
</body>
</html>