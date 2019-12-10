<?php 
  require_once 'init.php';
  require_once 'function.php';
  
  unset ($_SESSION['userID']);
  header('Location: index.php');
?>
