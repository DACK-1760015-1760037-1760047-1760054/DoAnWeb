<?php 
  require_once 'init.php';
  if (!$currentUser)
  {
  	header('location: home.php');
  	exit();
  }
  
	$userId = $_POST['id'];
	$profile = findUserById($userId);
	sendFriendRequest($currentUser[0]['id'],$profile[0]['id']);
	
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      if(isset($_POST['id']))
      {
		$i = $currentUser[0]['id'];
		$l = "<a href =\"$BASE_URL/profile.php?id=$i\">$BASE_URL/profile.php?id=$i</a>";
        $td = 'Bạn nhận được lời mời kết bạn từ '.$currentUser[0]['fullname'].' ';
        $nd = $currentUser[0]['fullname'].' đã gửi cho bạn lời mời kết bạn.' .$l. '';
        sendEmail($profile [0]['email'], $profile [0]['fullname'], $td, $nd);
      }
    }
  
     
	header('location:profile.php?id=' . $_POST['id'])
?>
