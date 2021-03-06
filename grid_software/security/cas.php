<?php

// 2004-10-18, robinett: created, copied information from www.globus.org/gridware/security/voms.html

$title = "Grid Ecosystem - CAS";
$section = "section-4";
include_once( "../../include/local.inc" );
include_once( $SITE_PATHS["SERV_INC"].'header.inc' ); 
include($SITE_PATHS["SERV_INC"] . "app-info.inc");
?>
<!--
<div id="left">
<?php include($SITE_PATHS["SERV_INC"].'software.inc'); ?>
</div>
-->

<div id="main">


<h1 class="first">CAS - Community Authorization Service</h1>

<p>
Building on GSI, the CAS component of the Globus Toolkit allows resource providers to specify 
coarse-grained access control policies in terms of communities as a whole, delegating 
fine-grained access control policy management to the community itself.
</p>

<p>
Resource providers maintain ultimate authority over their resources (including per-user control and auditing) but are spared most day-to-day policy administration tasks (e.g., adding and deleting users in groups, modifying user privileges).
</p>

<?
$software = "<a href='http://www-unix.globus.org/toolkit/docs/4.0/security/cas/'>CAS</a>";
$developer = "<a href='http://www.globus.org/'>The Globus Alliance</a>";
$distros = "<a href='http://www-unix.globus.org/toolkit/'>Globus Toolkit 4.0</a><br /><a href='http://collab.nsf-middleware.org/Lists/NMIR7/AllItems.aspx'>NMI-R7</a>";
$contact = "<a href='mailto:info@globus.org'>info@globus.org</a>";

// use the function below once problem is discovered, remove the two lines above
app_info($software, $developer, $distros, $contact);

?>

<p></p>


</div>

<?

include($SITE_PATHS["SERV_INC"].'footer.inc');

?>
