<?php
// Gọi thư viện
require_once ('./vendor/autoload.php');
require_once 'config.php';
require_once 'function.php';
ob_start();

//Thông báo lỗi
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Start session
session_start();

//Detect Page
$page = detectPage();

//Connect Database
global $DB_HOST,$DB_NAME,$DB_USER,$DB_PASSWORD ;
$db = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8",$DB_USER, $DB_PASSWORD);

//Detect User
$currentUser = null;
if (isset($_SESSION['userID']))
{
	$currentUser = findUserById($_SESSION['userID']);
}
