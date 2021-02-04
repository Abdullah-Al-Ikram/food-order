<?php 
include('../Config/constants.php');
//distory the session
session_destroy();
header('location:'.SITEURL.'admin/login.php');
?>