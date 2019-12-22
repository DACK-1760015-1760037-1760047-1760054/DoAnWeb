<?php

require_once 'init.php';
require_once 'function.php';
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

$postId = $_GET['postID'];
$privacy = $_GET['privacy'];
setPrivacy($postId,$privacy);

$for = $_GET['for'];

if(!empty($for))
{
    echo "12321";
    header("Location:pagePersonal.php");
}
else
{
    header("Location:home.php"); 
}

?>