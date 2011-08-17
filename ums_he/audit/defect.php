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
<body>
<fieldset>
<legend>DEFECT LOG</legend>
<p></p>
<div id="demo">
<table cellpadding="0" cellspacing="0" border="1" bordercolor="black" class="display" id="example">
	<thead>
		<tr align="left">
			<th>Defect No</th>
			<th>Action</th>
			<th>Email</th>
			<th>Date</th>
			<th>IP Address</th>
		</tr>
	</thead>
	<tbody>
<?php
require("../library/connection.php");

$sql = "SELECT * FROM defectlog";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

?>
	<tr>
	<td><?php printf("%s",$myrow["id"]); ?></td>
	<td><?php printf("%s",$myrow["action"]); ?></td>
	<td><?php printf("%s",$myrow["chgby"]); ?></td>
	<td><?php printf("%s",$myrow["date"]); ?></td>
	<td><?php printf("%s",$myrow["ip"]); ?></td>
	</tr>
<?php
} while ($myrow = mysql_fetch_array($result));

} else {
	echo "No information."; 
}
?>		
</table>
</div>
</fieldset>
</body>
</html>
