<?php 
  require_once 'init.php';
  $posts = getNewFeeds();
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lấy lại Mật Khẩu</title>
	<style>
		input[type=text] {width: 60%;}
		label {font-size: "2"; font-family: Times New Roman;}
		a { font-size:110%;font-weight:bold;font-family: Times New Roman;};
		.box{
        font-size: 20px;
        width:100px;
        height:100px;
        padding: 50px;
        border:10px solid black;}
        .textarea {
		  width: 40%;
		  height: 200px;
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
		<center><h1 style="font-family:Georgia">Quên Mật Khẩu</h1>
		<?php if (isset($_POST['Email'])): ?> 
		<?php
			$Email = $_POST['Email'];
			$success = false;	
			$user =null;		
			$user = findUserByEmail($Email);			
			if ($user !=null)
			{
				$_SESSION['Email']=$Email;
				forgotPass($Email);
				$success = true;
			}
		?>
		<?php if ($success): ?>
		<div class="alert alert-success" role = "alert">
			Vui lòng kiểm tra <strong>Email</strong> để lấy mật khẩu mới của tài khoản
			<?php header('Location: newPassword.php'); ?>
		</div>
		<?php else: ?>
		<div class="alert alert-danger" role = "alert">
			Email không tồn tại, Không thành công!!:)
		</div>
		<?php endif; ?>
		<?php else: ?>
		<form action="forgotPassword.php" method="POST">
			<fieldset class="textarea">
			<div class="form-group">
				<label for="Email"><strong>Email</strong></label>
				<input type="email" class="form-control" id="Email" placeholder="Nhập Email" name="Email">
			</div>			
			<button type="Submit" class="btn btn-success"><b>Lấy lại Mật Khẩu</b></button>&emsp;
			<a href="index.php"><b>Hủy</b></a>
			</fieldset>
		</form></center>
	</div>
</body>
</html>
<?php endif; ?>
<hr>
<?php include 'footer.php'; ?>