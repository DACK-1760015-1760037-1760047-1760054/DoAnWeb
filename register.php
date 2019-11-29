<?php 
  require_once 'init.php';
  
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Đăng Ký</title>
	<style>
		label {font-size: "2"; font-family: Times New Roman;}
		a { font-size:110%;font-weight:bold;font-family: Georgia;};
		.box{
        font-size: 20px;
        width:300px;
        height:300px;
        padding: 50px;
        border:10px solid black;}
        .textarea {
		  width: 50%;
		  height: 430px;
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
		<center><h1 style="font-family:Georgia">Đăng Ký</h1>
		<?php if (isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['password'])): ?>
		<?php
			$fullname = $_POST['fullname'];
			$email = $_POST['email'];
			$password = $_POST['password'];		
			$hashPassword = password_hash($password, PASSWORD_DEFAULT);

			$success = false;			
			$user = findUserByEmail($email);
			if (! $user)
			{
				$newUserID = createUser($fullname,$email, $password);
				// $_SESSION['userID'] = $newUserID;
				$success = true;
			}
		?>
		<?php if ($success): ?>
		<div class="alert alert-success" role = "alert">
			Vui lòng kiểm tra <strong>Email</strong> để kích hoạt tài khoản
		</div>
		<?php else: ?>
		<div class="alert alert-danger" role = "alert">
			Đăng Ký Không thành công!!Mời đăng ký lại :)
		</div>
		<?php endif; ?>
		<?php else: ?>		
		<form action="register.php" method="POST">
			<fieldset class="textarea">				
				<legend><center>Personal information:</center></legend>
				<p class="left">
				<label for="fullname"><strong>Họ Tên</strong></label>
				<input type="fullname" class="form-control" id="fullname" placeholder="Nhập tên đầy đủ của bạn" name="fullname"><br>
				<label for="email"><strong>Email</strong></label>
				<input type="email" class="form-control" id="email" placeholder="Nhập Email" name="email"><br>
				<label for="password"><strong>Password</strong></label>
				<input type="password" class="form-control" id="password" placeholder="Nhập Password" name="password"><br>				
				<button type="Submit" class="btn btn-success"><b>Đăng Ký</b></button>
				<a href="login.php"><b>Hủy</b></a></p>
			</fieldset>		
		</form></center>
	</div>
</body>
</html>
<?php endif; ?>
<?php include 'footer.php'; ?>
