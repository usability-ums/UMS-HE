<?php
require("../library/duration.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<table border="1" bordercolor="grey" width="100%">
<tr><td>
<table id="linktb" cellspacing="0">
	<tr>
		<td style="background-color:dodgerblue">
		<font color="white"><b>Defect Menu</b></font>
		</td>
	</tr>	
	<tr>
		<td style="background-color:#B0E2FF">		
		<a href="../defect/adddefect.php" target="home" >Add New Defect</a>
		</td>
	</tr>
	<tr>
		<td style="background-color:#D1EEEE">		
		<a href="../defect/modifydefect.php" target="home" >Modify Defect</a>
		</td>
	</tr>
	<tr>
		<td style="background-color:#B0E2FF">		
		<a href="../defect/present.php" target="home" >Present Defect</a>
		</td>
	</tr>
	<tr>
		<td style="background-color:#D1EEEE">		
		<a href="../defect/verify_defect.php" target="home" >Verify Defect</a>
		</td>
	</tr>
	<tr>
		<td style="background-color:#B0E2FF">		
		<a href="../defect/convert.php" target="home" >Transform Defect to PPT Format</a>
		</td>
	</tr>
	</table>
</td></tr>
</table>
</body>
</html>