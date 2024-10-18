<?php
include('library/config.php');

if( isset($_SESSION['UserId']))
{
    include(TEMPLATE.'_public.php');
}else {
    echo "<script>window.location=\"login.php\";</script>";
}
?>