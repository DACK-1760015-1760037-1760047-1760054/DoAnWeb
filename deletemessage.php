<?php
require_once 'init.php';
if (!$currentUser)
  {
  	header('location: home.php');
  	exit();
  }
$messages = getMessagesWithUserId($currentUser[0]['id'], $_GET['id']);
$id = $messages['id'];
$dele = deleteMess($id);
header('location: message.php');


?>