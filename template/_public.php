<?php

if (isset($_GET['page']))
    new template(SITE_PATH, $_GET['page'] . ".php");
else
    new template(SITE_ROOT, "login.php");
?>