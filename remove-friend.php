<?php 
  require_once 'init.php';
  if (!$currentUser)
  {
  	header('location: home.php');
  	exit();
  }
	$userId = $_POST['id'];
	$profile = findUserById($userId);
	removeFriendRequest($currentUser[0]['id'],$profile[0]['id']);

	header('location:profile.php?id=' . $_POST['id'])
?>
