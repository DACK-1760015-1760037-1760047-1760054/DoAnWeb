<?php 
  require_once 'init.php';
  if (!$currentUser)
  {
  	header('location: home.php');
  	exit();
  }
  $posts = getNewFeeds();
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Đổi Mật Khẩu</title>
	<style>
		/*input[type=text] {width: 60%;}*/
		label {font-size: "2"; font-family: Times New Roman;}
		a { font-size:110%;font-weight:bold;font-family: Times New Roman;};
		.box{
        font-size: 20px;
        width:300px;
        height:300px;
        padding: 50px;
        border:10px solid black;}
        .textarea {
		  width: 40%;
		  height: 350px;
		  padding: 12px 20px;
		  box-sizing: border-box;
		  border: 2px solid #ccc;
		  border-radius: 4px;
		  background-color: #f8f8f8;
		  resize: none;
		}
		.left {
       text-align: left;
    }
	</style>
</head>
<body>
	<div class="container">
		<center>
		<?php if (isset($_POST['oldpassword']) && isset($_POST['Password'])): ?>
		<?php
			$oldpassword = $_POST['oldpassword'];
			$Password = $_POST['Password'];
			

			$success = false;
		
			if (password_verify($oldpassword, $currentUser[0]['password']))
			{
				updatePassword($currentUser[0]['id'], $Password);
				$success = true;
			}
		?>
		<?php if ($success): ?>
		<?php header('Location: home.php'); ?>
		<?php else: ?>
		<div class="alert alert-danger" role = "alert">
			Đổi Mật Khẩu Thất Bại:)
		</div>
		<?php endif; ?>
		<?php else: ?>
		<form action="changePassword.php" method="POST">
			<fieldset class="textarea">	
			<legend><h2 style="font-family:Georgia">Đổi Mật Khẩu</h2></legend>
			<p class="left">
			<div class="from-group">
				<label for="oldpassword"><strong>Mật Khẩu Cũ</strong></label>
				<input type="password" class="form-control" id="oldpassword" placeholder="Nhập mật khẩu hiện tại" name="oldpassword">
			</div>
			<div class="from-group">
				<label for="Password"><strong>Mật khẩu Mới</strong></label><br>
				<input type="password" class="form-control" id="Password" placeholder="Nhập mật khẩu mới" name="Password"><br>
			<button type="Submit" class="btn btn-success"><b>Đổi Mật Khẩu</b></button>&emsp;
			<a href="home.php"><b>Hủy</b></a></p>
			</fieldset>	
		</form>
		</center>
	</div>
</body>
</html>
<?php endif; ?>
<hr>
<?php include 'footer.php'; ?>