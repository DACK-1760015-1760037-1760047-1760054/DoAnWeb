<?php
require_once 'init.php';
  if (!$currentUser)
  {
  	header('location: home.php');
  	exit();
  }

  $content = $_POST['content'];

  createPosts($currentUser[0]['id'], $content);

  header('location: home.php');
?>