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
<legend>OVERALL DEFECT REPORT</legend>   
<script>
    function docheck(){
        if(document.form1.pid.value==""){
        alert("Please select a project name!");
        return false;
        }
    }
</script>
<form name="form1" action="overall.php" method="POST" onsubmit="return docheck()">
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
	echo "<p>No information.</p>";  
}

mysql_close($con);
?>

</select>
</td>
<td>
<input type="submit" name="submit" value="SEARCH">
</td>
</tr>
</table>
</form>
<?php
if($_POST["pid"] !=""){
?>
<h2><?php printf("%s",$_POST["pid"]); ?></h2>
<?php
require("../library/connection.php");

$sqlm = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND severity='Major' AND status!='Duplicate' AND status!='Rejected' AND status!='Closed' AND status!='Postponed'"; 
$resultm = mysql_query($sqlm) or die(mysql_error()); 
$cm = mysql_fetch_array($resultm);

$major=$cm["t_points"];

$sqlc = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND severity='Critical' AND status!='Duplicate' AND status!='Rejected' AND status!='Closed' AND status!='Postponed'";
$resultc = mysql_query($sqlc) or die(mysql_error()); 
$cc = mysql_fetch_array($resultc);

$critical=$cc["t_points"];

$total=$critical+$major;

if($total =='0'){
?>
<table><tr>
<td><img src="../images/greenlight.png"/></td>
<td>Green light, no critical and major defects.</td>
</tr></table>
<?php
}else{
?>
<table><tr>
<td><img src="../images/redlight.png"/></td>
<td>Red light, <?php printf("%s",$critical); ?> critical and <?php printf("%s",$major); ?> major defects.</td>
</tr></table>
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
		</tr>
	</thead>
	<tbody>
<?php
require("../library/connection.php");

$sql = "SELECT * FROM defect WHERE project='$_POST[pid]' AND severity!='Minor' AND status!='Duplicate' AND status!='Rejected' AND status!='Closed' AND status!='Postponed'";
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
	<td><a href="../defect/uploads/<?php printf("%s",$myrow["file"]); ?>" target="_blank"><?php printf("%s",$myrow["id"]); ?></a></td>
	<td><?php printf("%s",$string1); ?></td>
	<td><?php printf("%s",$string2); ?></td>
	<td><?php printf("%s",$string3); ?></td>
	<td><?php printf("%s",$myrow["severity"]); ?></td>
	<td><?php printf("%s",$string4); ?></td>
	<td><?php printf("%s",$myrow["status"]); ?></td>
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
}}
?>   
</fieldset>
</body>
</html>
