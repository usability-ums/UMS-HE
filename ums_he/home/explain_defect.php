<?php
require("../library/duration.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>DEFECT STATUS EXPLANATION</legend>
<p><u><b>1) Submitted</b></u><br/>
This is the initial state of a PR/CR report. A defect is in this state when it is first submitted to the system.<br/></p>
<p><u><b>2) Opened</b></u><br/>
After the debate, if a PR/CR in Open state is found to be a valid defect.</p>
<p><u><b>3) Rejected</b></u><br/>
After the debate, if a PR/CR in Open state is found to be not a bug or invalid.</p>
<p><u><b>4) Duplicate</b></u><br/>
This is the state when the PR/CR that been captured twice.</p>
<p><u><b>5) KIV</b></u><br/>
This is the state when the PR/CR is on hold for the next debate.</p>
<p><u><b>6) Resolved</b></u><br/>
When the developer has completed work and unit testing of the changes made, the PR/CR may be moved into the Resolved state. After the PR/CR has been resolved, usability engineer will verify the resolved PR/CR.</p>
<p><u><b>7) Closed</b></u><br/>
This is the state where the PR/CR has been verified and tested.</p>
<p><u><b>8) Postponed</b></u><br/>
This is the state when the PR/CR will be postponed until next version.</p>
</fieldset>
</body>
</html>