<?php
require_once 'init.php';
if (!$currentUser){
	header('Location: home.php');
	exit();
}
$content = $_GET['content'];
$postID = $_GET['postid'];
$userID = $currentUser[0]['id'];

createCmt($userID, $content,$postID);
header('Location: home.php');