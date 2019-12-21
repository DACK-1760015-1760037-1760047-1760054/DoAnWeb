<?php 
  require_once 'init.php';
  if (!$currentUser)
  {
  	header('location: home.php');
  	exit();
  }
	$userId = $currentUser[0]['id'];
	$friends = getFriends($userId);
	$profile = findUserById($userId);
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Friend</title>
	<style>
	</style>		
</head>
<body>
	<div class="container">
		<fieldset class="textarea">
			<legend><h4 style = "font-family:Georgia;color:blue"><strong><marquee direction="right">Bạn Bè của <?php echo $profile ? ' ' . $profile[0]['fullname'] . ' ' : ' ' ?></marquee></strong></h4></legend>			
			<?php foreach($friends as $friend) : ?>				
				<div class="card-deck">
					<div class="card-columns">
					    <img style="max-height:500px" class="card-img-top"src="<?php echo 'data:image/jpeg;base64,' . base64_encode($friend[0]['avatar']); ?>">
					    <div class="card-body">
						    <center><h4 class="card-title"style="margin-top:50px"><strong  style = "font-family:Georgia"><?php echo $friend[0]['fullname']; ?></strong></h4></center>
						    <center><a class="btn btn-info" href="profile.php?id=<?php echo $friend[0]['id'];?>"><b>Trang cá nhân</b></a>&ensp;
							<a class="btn btn-primary" href="conversation.php?id=<?php echo $friend[0]['id'];?>"><b>Nhắn tin</b></a><br><br>
							<button><a href="#"><span style="color:dimgrey;font-size=20px;" class='fas'>&#xf00c; <b>Bạn bè</b></span></a></button></center>
					    </div>
					</div><br>
				</div>
			<?php endforeach; ?>			
		</fieldset>
	</div>
</body>
</html>
<hr>
<?php include 'footer.php'; ?>