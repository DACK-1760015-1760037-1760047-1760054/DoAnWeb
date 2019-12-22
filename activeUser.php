<?php 
  require_once 'init.php';
  $posts = getNewFeeds();
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Kích Hoạt Tài Khoản</title>
	<style>		
		input[type=text] {width: 60%;}
		label {font-size: "2"; font-family: Times New Roman;}
		.box{
        font-size: 20px;
        width:300px;
        height:300px;
        padding: 50px;
        border:10px solid black;}
        .textarea {
		  width: 40%;
		  height: 250px;
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
			<legend><h2><center style="font-family:Georgia">Kích Hoạt Tài Khoản</center></h2></legend>
			<?php if (isset($_GET['code'])): ?>
			<?php 
				$code = $_GET['code'];
				$success = false;
				
				$success = activeUser($code);
			?>
			<?php if ($success): ?>
			<?php header('Location: login.php'); ?>
			<?php else: ?>
			<div class="alert alert-danger" role = "alert">
				Kích hoạt tài khoản không thành công!
			</div>
			<?php endif; ?>
			<?php else: ?>
			<form method="GET">
				<p class="left">
				<div class="form-group">
					<label for="code"><strong>Mã Kích Hoạt</strong></label>
					<input type="text" class="form-control" id="code" placeholder="Nhập code" name="code">
				</div>			
				<button type="Submit" class="btn btn-success"><b>Kích hoạt</b></button></p>
			</form>
		</fieldset></center>
	</div>
</body>
</html>
<?php endif; ?>
<hr>
<?php include 'footer.php'; ?>