<?php

if (isset($_GET['page']))
    new template(ADMIN_PATH, $_GET['page'] . ".php");
else if (isset($_GET['rptpage']))
    new template(RPT_PATH, $_GET['rptpage'] . ".php");
else
    new template(ADMIN_PATH, "home.php");
?>