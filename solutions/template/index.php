<?php
$title = "Grid Solutions - [name of solution]";
$section = "section-5";
include_once( "../../include/local.inc" );
include_once( $SITE_PATHS["SERV_INC"].'header.inc' ); 
include_once($SITE_PATHS["SERV_INC"] . "app-info.inc");
?>
<!--<div id="left">
<?php include($SITE_PATHS["SERV_INC"].'solutions.inc'); ?>
</div>
-->

<div id="main">

<h1 class="first">[name of solution]</h1>

<div style="float: right; margin-left: 10px; margin-bottom: 10px;">
<img border=0 src="solutions-image-sample.jpg" width=450 height=350>
</div>
<p>
[Write a brief description of what the science project is doing (about a paragraph).]
</p>

<h2>The Challenge</h2>

<p>
[Include information about the specific challenge in the science project's work that is motivating this solution (what was limiting them from doing what they wanted to do).]</p>


<div id="solutions-sidebar" style="float: right; margin-right: 1em">
<h2>More Information</h2>
<ul>
<li><a href="architecture.php">Architecture of [the solution]</a></li>
<li><a href="resources.php">Software availability</a></li>
<li><a href="deployment.php">Deployment details</a></li>
<li><a href="#">[helpful external links]</a></li>
</ul>
</div>


<h2>The Solution</h2>

<p>
[Write about how this solution meets the challenge.]
</p>

<h2>Results</h2>

<p>
[When available, provide preliminary results from the solution.]
</p>

<h2>Detailed Information</h2>

<p>The following links provide more detail about [the solution].</p>

<ul>
<li><a href="architecture.php">Architecture of [the solution]</a></li>
<li><a href="resources.php">Software availability</a></li>
<li><a href="deployment.php">Deployment details</a></li>
<li><a href="#">[helpful external links]</a></li>

</ul>

</div>

<?
include($SITE_PATHS["SERV_INC"].'footer.inc');
?>
