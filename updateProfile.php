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
	<title>Thông Tin Cá Nhân</title>
	<style>
		input[type=text] {width: 60%;}
		label {font-size: "2"; font-family: Times New Roman;}
		a { font-size:100%;font-weight:bold;font-family: Times New Roman;};
		.box{
        font-size: 20px;
        width:300px;
        height:300px;
        padding: 50px;
        border:10px solid black;}
        .textarea {
		  width: 50%;
		  height: 1320px;
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
		<center><h1 style="font-family:Georgia">Cập Nhật Thông Tin Cá Nhân</h1>
		<?php if (isset($_POST['fullname']) && isset($_POST['gioitinh']) && isset($_POST['ngaysinh'])&&isset($_POST['bietdanh'])&&isset($_POST['tieusu'])&&isset($_POST['phonenumber']) && isset($_POST['quequan'])&&isset($_POST['address']) && isset($_POST['workplace'])) : ?>
		<?php
		    
		    $fullname= $_POST['fullname'];
		    $gioitinh= $_POST['gioitinh'];
		    $ngaysinh= $_POST['ngaysinh'];
		    $bietDanh= $_POST['bietdanh'];
		    $tieuSu= $_POST['tieusu'];
		    $phoneNumber= $_POST['phonenumber'];
		    $queQuan= $_POST['quequan'];
		    $address= $_POST['address'];
		    $workPlace= $_POST['workplace'];

		    $success =false;

		    if(isset($_FILES['avatar']) && isset($_FILES['anhbia'])) {
		        $success = false;
		        $file = $_FILES['avatar'];
		        $fileType = $file['type'];
		        $fileTemp = $file['tmp_name'];
		        $file1 = $_FILES['anhbia'];
		        $fileType1 = $file1['type'];
		        $fileTemp1 = $file1['tmp_name'];

		        $avatar = file_get_contents($fileTemp);
		        $anhbia = file_get_contents($fileTemp1);

		        if($fullname != null){
		          updateUserProfile($currentUser[0]['id'],$fullname,$fileType1,$anhbia,$fileType,$avatar,$bietDanh,$tieuSu,$queQuan,$address,$workPlace,$phoneNumber,$gioitinh,$ngaysinh);
		          $success = true;
		      	}
		    }
		?>
		<?php if ($success): ?>
		<?php header('Location: home.php'); ?>
		<?php else: ?>
		<div class="alert alert-danger" role = "alert">
			Cập Nhật Thông Tin Thất Bại:)
		</div>
		<?php endif; ?>
		<?php else: ?>
		<form method="POST" enctype="multipart/form-data" class="was-validated">
			<fieldset class="textarea">	
				<legend><h2 style="font-family:Georgia">Information</h2></legend>
					<div class="card">
						<div class="form-group">
							<label for="anhbia"><strong>Ảnh Bìa</strong></label>
							<input type="file" class="file" id="anhbia" name="anhbia">
						</div>

						<div class="form-group">
							<label for="avatar"><strong>Ảnh Đại Diện</strong></label>
							<input type="file" class="file" id="avatar" name="avatar">
						</div>

						<div class="form-group">
							<label for="fullname"><strong>Họ Tên</strong></label>
							<input  class="form-control" id="fullname" name="fullname" placeholder="Tên của bạn" value="<?php echo $currentUser[0]['fullname']; ?>"required>
							<div class="valid-feedback">Thành công.</div>
	      					<div class="invalid-feedback">Vui lòng điền vào trường này.</div>
						</div>

						<div class="form-group">
							<label for="gioitinh"><strong>Giới Tính</strong></label>
							<input  class="form-control" id="gioitinh" name="gioitinh" placeholder="Giới tính của bạn"required>
							<div class="valid-feedback">Thành công.</div>
	      					<div class="invalid-feedback">Vui lòng điền vào trường này.</div>
						</div>

						<div class="form-group">
							<label for="ngaysinh"><strong>Ngày Sinh</strong></label>
							<input  class="form-control" id="ngaysinh" name="ngaysinh" placeholder="Sinh nhật của bạn"required>
							<div class="valid-feedback">Thành công.</div>
	      					<div class="invalid-feedback">Vui lòng điền vào trường này.</div>
						</div>

						<div class="form-group">
							<label for="bietdanh"><strong>Biệt Danh</strong></label>
							<input  class="form-control" id="bietdanh" name="bietdanh" placeholder="Mọi người gọi bạn với biệt danh gì?"required>
							<div class="valid-feedback">Thành công.</div>
	      					<div class="invalid-feedback">Vui lòng điền vào trường này.</div>
						</div>

						<div class="form-group">
							<label for="bietdanh"><strong>Tiểu Sử</strong></label>
							<input class="form-control" id="tieusu" name="tieusu" placeholder="Giới thiệu vài dòng về bạn nào!"required>
							<div class="valid-feedback">Thành công.</div>
	      					<div class="invalid-feedback">Vui lòng điền vào trường này.</div>
						</div>

						<div class="form-group">
							<label for="phonenumber"><strong>Số Điện Thoại</strong></label>
							<input  class="form-control" id="phonenumber" name="phonenumber" placeholder="Số điện thoại của bạn"required>
							<div class="valid-feedback">Thành công.</div>
	      					<div class="invalid-feedback">Vui lòng điền vào trường này.</div>
						</div>

						<div class="form-group">
							<label for="quequan"><strong>Đến Từ</strong></label>
							<input  class="form-control" id="quequan" name="quequan" placeholder="Bạn đến từ đâu nhỉ?"required>
							<div class="valid-feedback">Thành công.</div>
	      					<div class="invalid-feedback">Vui lòng điền vào trường này.</div>
						</div>

						<div class="form-group">
							<label for="address"><strong>Sống Tại</strong></label>
							<input  class="form-control" id="address" name="address" placeholder="Hiện tại bạn đang sống tại đâu?"required>
							<div class="valid-feedback">Thành công.</div>
	      					<div class="invalid-feedback">Vui lòng điền vào trường này.</div>
						</div>

						<div class="form-group">
							<label for="workplace"><strong>Nơi Làm Việc/Học Tập</strong></label>
							<input  class="form-control" id="workplace" name="workplace" placeholder="Bạn làm việc ở đâu?"required>
							<div class="valid-feedback">Thành công.</div>
	      					<div class="invalid-feedback">Vui lòng điền vào trường này.</div>
						</div>
						<button type="Submit" class="btn btn-success"><b>Cập Nhật</b></button>		
						<a href="home.php"><b>Hủy</b></a>
						<a href="changePassword.php">Đổi Mật Khẩu</a>
					</div>
			</fieldset>
		</form>
		<?php endif; ?>
		</center>
	</div>
</body>
</html>
<hr>
<?php include 'footer.php'; ?>