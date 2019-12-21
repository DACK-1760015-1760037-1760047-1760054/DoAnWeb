<?php 
  	require_once 'init.php';
  	$posts = getNewFeeds();
  	$success = false;	
	$user =null;
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Mới</title>
	<style>
		input[type=text] {width: 60%;}
		label {font-size: "2"; font-family: Times New Roman;}
		
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
		<center><fieldset class="textarea">
		<legend><h2><center style="font-family:Georgia">Đặt Mật Khẩu Mới</center></h2></legend>
		<?php if (isset($_POST['code']) &&  isset($_POST['newPassword'])): ?> 
		<?php
			$code_input =$_POST['code'];
			$new_password = $_POST['newPassword'];
			$Email=$_SESSION['Email'];
			$user=findUserByEmail($Email);
			$ID=FindIDUserByEmail($Email);
			if($user != null)
			{
				if(CheckingAuthCodeByEmail($code_input,$Email))
				{
					updatePassword($ID, $new_password);
					$success = true;
				}				
			}
		?>
		<?php if ($success): ?>
		<div class="alert alert-success" role = "alert">
			<?php header('Location: login.php'); ?>
		</div>
		<?php else: ?>
		<div class="alert alert-danger" role = "alert">
			Lấy Lại Password Không Thành Công !!
		</div>
		<?php endif; ?>
		<?php else: ?>
		<form action="newPassword.php" method="POST">		
				<div class="form-group">
					<label for="code"><strong>Mã Kích Hoạt</strong></label>
					<input type="code" class="form-control" id="code" placeholder="Nhập code đã gửi trong email của bạn" name="code">
				</div>
				<div class="form-group">
					<label for="newPassword"><strong>New Password</strong></label>
					<input type="password" class="form-control" id="newPassword" placeholder="Nhập vào Password mới" name="newPassword">
				</div>			
				<button type="Submit" class="btn btn-success"><b>Hoàn Thành</b></button>	
		</form>
		</fieldset></center>
	</div>
</body>
</html>
<?php endif; ?>
<hr>
<?php include 'footer.php'; ?>