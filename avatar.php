<?php
    require_once 'init.php';
    $row = loadAvatars($currentUser[0]['id']);
    header('Content-Type:'.$row['mimeava']);
    echo $row['avatar'];

    
?>
