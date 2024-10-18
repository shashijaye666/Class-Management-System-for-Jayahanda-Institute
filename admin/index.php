<?php
include('../library/config.php');
if( isset($_SESSION['UserId']))
{
    include(TEMPLATE.'_admin.php');
}else {

    header("Location:login.php");
}



?>