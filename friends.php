<?php 
  require_once 'init.php';
  if (!$currentUser)
  {
  	header('location: home.php');
  	exit();
  }
	$userId = $_GET['id'];
	$profile = findUserById($userId);
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Friend</title>
	<style>
		a { font-size:100%;font-weight:bold;font-family: Times New Roman;};	
	</style>		
</head>
<body>
	<div class="container">
		<h4 style = "font-family:Georgia;color:blue"><strong><marquee direction="right">Bạn Bè của <?php echo $profile ? ' ' . $profile[0]['fullname'] . ' ' : ' ' ?></marquee></strong></h4>
		<img style="width:120px" class="rounded-circle" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($profile[0]['avatar']); ?>"><strong style = "font-family:Georgia;font-size:3"><?php echo $profile ? ' ' . $profile[0]['fullname'] . ' ' : ' ' ?></strong><br>
		<a href="profile.php?id=<?php echo $profile[0]['id'];?>"><b>Trang cá nhân</b></a>&emsp;
		<a href="chat.php"><b>Nhắn tin</b></a>
	</div>
</body>
</html>
<!-- <p><iframe src="https://www.nhaccuatui.com/mh/background/dkE0hFCviG1g" width="1" height="1" frameborder="0" allowfullscreen allow="autoplay"></iframe></p> -->
<?php include 'footer.php'; ?>