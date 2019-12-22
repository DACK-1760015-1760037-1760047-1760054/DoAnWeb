<?php
require_once 'init.php';
// connect to database
$conn = mysqli_connect('localhost', 'root', '', 'doan');

$id = $currentUser[0]['id'];

$sql= "SELECT * FROM comments";
$result = mysqli_query($conn, $sql);

$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
$name = $_POST['name'];

$comment = $_POST['comment'];
$sql="INSERT INTO comments (id, name, comment) 
              VALUES ($id, $name, $comment)";
$result = mysqli_query($conn, $sql);
var_dump($result);exit;


?>