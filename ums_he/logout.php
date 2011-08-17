<?php

setcookie("us", "",time()-21600, "/"); 
setcookie("rl", "",time()-21600, "/"); 
setcookie("un", "",time()-21600, "/"); 

session_start();
?>
<script type="text/javascript">
if(top!=self){
top.location=self.location;
}
</script>
<?php
session_destroy();
?>
<meta http-equiv="refresh" content="0; url=../index.php">
<html>
<title>Usability Management System (UMS)</title>
<link href="style/design.css" rel="stylesheet" type="text/css"/>
</html>
