<?php
require("../library/duration.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css" />
<body>
  	<table align="left">
	  <tr><td><img src="../images/ums.png"/></td></tr>
	</table>
  	<table style="margin-top: 8px;margin-right: 20px;" align="right">
	<tr>
		<td>
		    Hi, <a href="../account/profile.php" target="home"><?php printf("%s",$_COOKIE["un"]); ?></a> | 	 
		    <a href="../logout.php">Logout</a>
		</td>
	</tr>
	</table>
<p><br/><br/></p>
<hr size="3" width="100%" color="grey">
</body>
</html>