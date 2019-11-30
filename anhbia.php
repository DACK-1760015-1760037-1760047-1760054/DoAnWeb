<?php
    require_once 'init.php';
    $row = loadAvatars($currentUser[0]['id']);
    header('Content-Type:'.$row['mimebia']);
    echo $row['anhbia'];

    
?>
