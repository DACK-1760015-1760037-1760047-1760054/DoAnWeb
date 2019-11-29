<?php 
  require_once 'init.php';
  // hàm kích hoạt ở đâu ế
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<style>
		input[type=text] {width: 60%;}
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
       text-align: justify;
    }
	</style>
</head>
<body>
	<div class="container">
		<center><h1 style="font-family:Georgia">Đăng Nhập</h1>
		<?php if (isset($_POST['Email']) && isset($_POST['Password'])): ?>
		<?php 
			$Email = $_POST['Email'];
			$Password = $_POST['Password'];
			$success = false;
			
			$user = findUserByEmail($Email);
		
			if ($user && $user[0]['status'] == 1 && password_verify($Password, $user[0]['password']))
			{
				$success = true;
				$_SESSION ['userID'] = $user[0]['id'];
			}
		?>
		<?php if ($success): ?>
		<?php header('Location: index1.php'); ?>
		<?php else: ?>
		<div class="alert alert-danger" role = "alert">
			Đăng nhập Không thành công!!Mời đăng nhập lại :)
		</div>
		<?php endif; ?>
		<?php else: ?>			
		<form action="login.php" method="POST">
			<fieldset class="textarea">
				<legend><center>Login Information:</center></legend>
				<p class = "left">
				<label for="Email"><strong>Email</strong></label>
				<input type="email" class="form-control" id="Email" placeholder="Nhập vào Email" name="Email"><br>
				<label for="Password"><strong>Password</strong></label>
				<input type="password"class="form-control" id="Password" placeholder="Nhập vào mật khẩu" name="Password"><br>
				<button type="Submit" class="btn btn-success"><b>Đăng Nhập</b></button>&emsp;		
				<a href="index.php"><b>Hủy</b></a><br>
				<a href="forgotPassword.php">Quên Mật Khẩu?</a></p>
			</fieldset>
		</form></center>
	</div>
</body>
</html>
<?php endif; ?>
<!-- <p><iframe src="https://www.nhaccuatui.com/mh/background/HsVRhIfGJMpM" width="1" height="1" frameborder="0" allowfullscreen allow="autoplay"></iframe></p> -->
<?php include 'footer.php'; ?>