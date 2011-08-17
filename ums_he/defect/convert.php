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
<legend>CONVERT DEFECT</legend>
<p></p>
<?php
if($_POST["pid"] =="" && $_POST["pid1"] =="" && $_COOKIE["temp1"]==""){
?>
<form name="form1" action="convert.php" method="POST" onsubmit="return docheck1()">
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
<form name="form2" action="convert.php" method="POST" onsubmit="return docheck2()">
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

<?php
require("../library/connection.php");
$sql = "SELECT * FROM defect WHERE project='$_POST[pid1]' AND subproject='$_POST[pid2]' AND testingtype='$_POST[pid3]'";
$result = mysql_query($sql,$con);

/**
 * PHPPowerPoint
 *
 * Copyright (c) 2009 - 2010 PHPPowerPoint
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPPowerPoint
 * @package    PHPPowerPoint
 * @copyright  Copyright (c) 2009 - 2010 PHPPowerPoint (http://www.codeplex.com/PHPPowerPoint)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    0.1.0, 2009-04-27
 */

/** Error reporting */
error_reporting(E_ALL);

/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');

/** PHPPowerPoint */
include 'PHPPowerPoint.php';

/** PHPPowerPoint_IOFactory */
include 'PHPPowerPoint/IOFactory.php';

// Create new PHPPowerPoint object
$objPHPPowerPoint = new PHPPowerPoint();

// Set properties
$objPHPPowerPoint->getProperties()->setCreator("UMS");
$objPHPPowerPoint->getProperties()->setLastModifiedBy("UMS");
$objPHPPowerPoint->getProperties()->setTitle("Office 2007 PPTX Document");
$objPHPPowerPoint->getProperties()->setSubject("Office 2007 PPTX Document");
$objPHPPowerPoint->getProperties()->setDescription("Document for Office 2007 PPTX");
$objPHPPowerPoint->getProperties()->setKeywords("Office 2007");
$objPHPPowerPoint->getProperties()->setCategory("UMS");

// Remove first slide
$objPHPPowerPoint->removeSlideByIndex(0);

function createTemplatedSlide(PHPPowerPoint $objPHPPowerPoint, $image)
{
    // Create slide
    $slide = $objPHPPowerPoint->createSlide();
	
    // Add background image
    $shape = $slide->createDrawingShape();
    $shape->setName('Background');
    $shape->setDescription('Background');
    $shape->setPath('./uploads/realdolmen_bg.jpg');
    $shape->setWidth(950);
    $shape->setHeight(720);
    $shape->setOffsetX(0);
    $shape->setOffsetY(0);
    
    // Add image
    $shape = $slide->createDrawingShape();
    $shape->setName('Defect image');
    $shape->setDescription('Defect image');
    $shape->setPath('./uploads/'.$image);
    $shape->setWidth(1600);
    $shape->setHeight(380);
    $shape->setOffsetX(10);
    $shape->setOffsetY(120);
    
    // Return slide
    return $slide;
}
$count=0;
if ($myrow = mysql_fetch_array($result)){
do {

$count++;
$status = $myrow["status"];
$string = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["issue"]);
$string = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string));
$string1 = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["recommendation"]);
$string1 = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string1));
$string2 = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["screen"]);
$string2 = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string2));
$string3 = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["impact"]);
$string3 = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string3));

// Create templated slide
$currentSlide = createTemplatedSlide($objPHPPowerPoint,$myrow["file"]); // local function

// Create a shape (top)
$shape = $currentSlide->createRichTextShape();
$shape->setHeight(50);
$shape->setWidth(800);
$shape->setOffsetX(100);
$shape->setOffsetY(30);
$shape->getAlignment()->setHorizontal( PHPPowerPoint_Style_Alignment::HORIZONTAL_LEFT );

$textRun = $shape->createTextRun('Issue #'.$count.' - '.$myrow["severity"].' ('.$myrow["id"].')');
$textRun->getFont()->setBold(true);
$textRun->getFont()->setSize(32);
$textRun->getFont()->setColor( new PHPPowerPoint_Style_Color( '#CD9B1D' ) );

// Create a shape (right)
$shape = $currentSlide->createRichTextShape();
$shape->setHeight(500);
$shape->setWidth(330);
$shape->setOffsetX(620);
$shape->setOffsetY(130);
$shape->getAlignment()->setHorizontal( PHPPowerPoint_Style_Alignment::HORIZONTAL_LEFT );

$textRun = $shape->createTextRun('Issue');
$textRun->getFont()->setBold(true);
$textRun->getFont()->setSize(16);
$textRun->getFont()->setColor( new PHPPowerPoint_Style_Color( 'FFFFFFFF' ) );

$shape->createBreak();

$textRun = $shape->createTextRun($string);
$textRun->getFont()->setBold(true);
$textRun->getFont()->setSize(16);
$textRun->getFont()->setColor( new PHPPowerPoint_Style_Color( 'FFFFFFFF' ) );

$shape->createBreak();
$shape->createBreak();

$textRun = $shape->createTextRun('Recommendation');
$textRun->getFont()->setBold(true);
$textRun->getFont()->setSize(16);
$textRun->getFont()->setColor( new PHPPowerPoint_Style_Color( 'FFFFFFFF' ) );

$shape->createBreak();

$textRun = $shape->createTextRun($string1);
$textRun->getFont()->setBold(true);
$textRun->getFont()->setSize(16);
$textRun->getFont()->setColor( new PHPPowerPoint_Style_Color( 'FFFFFFFF' ) );

$shape->createBreak();
$shape->createBreak();

$textRun = $shape->createTextRun('Category');
$textRun->getFont()->setBold(true);
$textRun->getFont()->setSize(16);
$textRun->getFont()->setColor( new PHPPowerPoint_Style_Color( 'FFFFFFFF' ) );

$shape->createBreak();

$textRun = $shape->createTextRun($myrow["category"]);
$textRun->getFont()->setBold(true);
$textRun->getFont()->setSize(16);
$textRun->getFont()->setColor( new PHPPowerPoint_Style_Color( 'FFFFFFFF' ) );

$shape->createBreak();
$shape->createBreak();

$textRun = $shape->createTextRun('Screen');
$textRun->getFont()->setBold(true);
$textRun->getFont()->setSize(16);
$textRun->getFont()->setColor( new PHPPowerPoint_Style_Color( 'FFFFFFFF' ) );

$shape->createBreak();

$textRun = $shape->createTextRun($string2);
$textRun->getFont()->setBold(true);
$textRun->getFont()->setSize(16);
$textRun->getFont()->setColor( new PHPPowerPoint_Style_Color( 'FFFFFFFF' ) );

$shape->createBreak();
$shape->createBreak();

$textRun = $shape->createTextRun('Impact');
$textRun->getFont()->setBold(true);
$textRun->getFont()->setSize(16);
$textRun->getFont()->setColor( new PHPPowerPoint_Style_Color( 'FFFFFFFF' ) );

$shape->createBreak();

$textRun = $shape->createTextRun($string3);
$textRun->getFont()->setBold(true);
$textRun->getFont()->setSize(16);
$textRun->getFont()->setColor( new PHPPowerPoint_Style_Color( 'FFFFFFFF' ) );

// Save PowerPoint 2007 file
$fileName = $_POST["pid2"].'-'.$_POST["pid3"].'.pptx';
$objWriter = PHPPowerPoint_IOFactory::createWriter($objPHPPowerPoint, 'PowerPoint2007');
$objWriter->save($fileName);

} while ($myrow = mysql_fetch_array($result));

} else {

}

?>
<p>All defect for the project have been converted to power point slide. Download <a href="<?php printf("%s",$fileName); ?>">HERE</a>!</p>
<?php
}
?>
</fieldset>
</body>
</html>