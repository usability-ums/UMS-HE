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
		<font color="white"><b>Project Menu</b></font>
		</td>
	</tr>
	<tr>
		<td style="background-color:#B0E2FF">		
		<a href="../project/mainproject.php" target="home" >Add New Project</a>
		</td>
	</tr>
	<tr>
		<td style="background-color:#D1EEEE">		
		<a href="../project/subproject.php" target="home" >Add New Sub Project</a>
		</td>
	</tr>
	<tr>
		<td style="background-color:#B0E2FF">		
		<a href="../project/dmainproject.php" target="home" >Delete Project</a>
		</td>
	</tr>
	<tr>
		<td style="background-color:#D1EEEE">		
		<a href="../project/dsubproject.php" target="home" >Delete Sub Project</a>
		</td>
	</tr>			
	</table>
</td></tr>
</table>
</body>
</html>