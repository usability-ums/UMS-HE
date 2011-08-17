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

//define a max size for the uploaded images in Kb
define ("MAX_SIZE","2000"); 

//get the size of the image in bytes
//$_FILES['image']['tmp_name'] is the temporary filename of the file
//in which the uploaded file was stored on the server
$size=filesize($_FILES['userfile']['tmp_name']);

if($size <= MAX_SIZE*1024){

require("../library/connection.php");

function myAddSlashes($text) {
	if(get_magic_quotes_gpc())
		return $text;
	else
		return addslashes($text);		
}

function findexts ($filename) { 
$filename = strtolower($filename) ;
$exts = split("[/\\.]", $filename) ;
$n = count($exts)-1; $exts = $exts[$n];
return $exts;
}

$cheissue=myAddSlashes($_POST["is"]);
$cherecommendation=myAddSlashes($_POST["rc"]);
$chescreen=myAddSlashes($_POST["sc"]);
$cheenvironment=myAddSlashes($_POST["env"]);
$impact=myAddSlashes($_POST["im"]);

$ext = findexts ($_FILES['userfile']['name']) ;


$ran = rand () ; 
$ran2 = $_POST["no"]."-".$ran."."; 

$target_path = "uploads/";
$target_path = $target_path . $ran2.$ext; 
$provect= $ran2.$ext; 

?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<?php

date_default_timezone_set( 'Asia/Kuala_Lumpur' );
$handle = date('D d-m-Y hisa');

$sql="INSERT INTO defect (id,project,subproject,defecttype,testingtype,stage1,stage2,issue,category,severity,screen,recommendation,file,environment,submitdate,impact,raiseby)
VALUES
('$_POST[no]','$_POST[pj]','$_POST[spj]','$_POST[tp]','$_POST[ty]','$_POST[sp]','$_POST[st]','$cheissue','$_POST[ct]','$_POST[sr]','$chescreen','$cherecommendation','$provect','$cheenvironment','$handle','$impact','$_COOKIE[us]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

$copied = copy($_FILES['userfile']['tmp_name'], $target_path);

if (!$copied) 
{
	echo "<h1>Copy unsuccessfull!</h1>";
		
}

echo "<p>Defect \"$_POST[no]\" has been added successfully!</p>";

$ip=$_SERVER['REMOTE_ADDR'];

$sql="INSERT INTO defectlog (id,chgby,action,date,ip)
VALUES
('$_POST[no]','$_COOKIE[us]','Submitted','$handle','$ip')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

mysql_close($con);
}
?> 
</body>
</html>