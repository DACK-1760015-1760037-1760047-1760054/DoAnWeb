<?php 
  require_once 'init.php';

?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Giới Thiệu Trang Web</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<style>
		.new
		{
			column-count: 2;
		}
		.container {
		   width: 1000px;
		  padding: 10px;
		  overflow: auto;}
		#post {
		   	float: left;
		}
		#sidebar {
			 width: 360px;
			 height: 320px;
			 background: #e8e8e8;
			 float: right;
			}
		html, body {
		  width: 600px;
		  height: 400px;
		  margin: 0;
		  padding: 0;
		}


		.slider-container{
		  height: 400px;
		  width: 600px;
		  position: relative;
		  overflow: hidden; 
		  text-align: center;
		}

		.menu {
		  position: absolute;
		  left: 0;
		  z-index: 900;
		  width: 600px;
		  bottom: 0;
		}

		.menu label {
		  cursor: pointer;
		  display: inline-block;
		  width: 16px;
		  height: 16px;
		  background: #fff;
		  border-radius: 50px;
		  margin: 0 .2em 1em;
		  transition: all .3s ease;
		  &:hover {
		    background: red;
		  }
		}

		.slide {
		  width: 600px;
		  height: 400px;
		  position: absolute;
		  top: 0;
		  left: 100%;
		  z-index: 10;
		  padding: 8em 1em 0;
		  background-size: cover;
		  background-position: 50% 50%;
		  transition: left 0s .75s;
		}

		[id^="slide"]:checked + .slide {
		  left: 0;
		  z-index: 100;
		  transition: left .65s ease-out;
		}

		.slide-1 {
		  background-image: url("https://i.pinimg.com/564x/7d/32/cc/7d32ccc6520deda40dcd6a8aa745c2f2.jpg");
		}
		.slide-2 {
		  background-image: url("https://i.pinimg.com/originals/25/5a/4f/255a4ff25d962b9fcca3e74d2170da07.jpg");
		}
		.slide-3 {
		  background-image: url("https://noithatvantuong.vn/vnt_upload/product/11_2016/Lunawall-0040.jpg");
		}
		.slide-4 {
		  background-image: url("https://img.lovepik.com/photo/50060/2732.jpg_wh860.jpg");
		}
		.slide-5 {
		  background-image: url("https://i.pinimg.com/564x/d0/51/9b/d0519bc6232c0cf85604fcc09d4a0cdc.jpg");
		}
	</style>
</head>
<body>
	<div id="content" class="container" class="new"> 
	   <div id="post">
	   		<div class="slider-container">
			  	<div class="menu">
			    	<label for="slide-dot-1"></label>
			    	<label for="slide-dot-2"></label>
			    	<label for="slide-dot-3"></label>
			    	<label for="slide-dot-4"></label>
			    	<label for="slide-dot-5"></label>
			  	</div>
		  
			  	<input id="slide-dot-1" type="radio" name="slides" checked>
			    	<div class="slide slide-1"></div>
			  
			  	<input id="slide-dot-2" type="radio" name="slides">
			    	<div class="slide slide-2"></div>

			  	<input id="slide-dot-3" type="radio" name="slides">
			    	<div class="slide slide-3"></div>

			    <input id="slide-dot-4" type="radio" name="slides">
			    	<div class="slide slide-4"></div>

			    <input id="slide-dot-5" type="radio" name="slides">
			    	<div class="slide slide-5"></div>
			</div>
	   </div><br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
	   <div id="sidebar">
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
				<div class="form-group">
					<input type="email" class="form-control" id="Email" placeholder="Nhập Email của bạn" name="Email">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" id="Password" placeholder="Nhập vào Password " name="Password">
				</div>			
				<center><button type="Submit" class="btn btn-success"><b>Đăng Nhập</b></button></center><br>
				<center><a href="forgotPassword.php">Quên Mật Khẩu ?</a></center><br>
				<center><button type="Submit" class="btn btn-success"><b><a href="register.php">Tạo Tài Khoản Mới</a></b></button></center>
			</form>
			<?php endif; ?></center>
	   </div>
	   <div class="clear"></div> 
	</div>
</body>
</html>
<?php include 'footer.php'; ?>