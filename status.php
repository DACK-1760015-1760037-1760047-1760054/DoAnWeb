<?php
require_once 'init.php';
  if (!$currentUser)
  {
  	header('location: home.php');
  	exit();
  }
  $privacy=1;
  $avatar = null;
  if(isset($_POST['post']) && isset($_FILES['img'])) {
    $avatar = file_get_contents($_FILES['img']['tmp_name']);
    if(empty($_POST['content'])==false )
    {
      $privacy = $_POST['id_privacy'];
  $content = $_POST['content'];
  $result = createPosts((int)$currentUser[0]['id'], $content, $avatar, $privacy);

  header('location: home.php');
    }
  }

?>