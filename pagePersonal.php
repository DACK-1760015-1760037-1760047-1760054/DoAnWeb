<?php 
  require_once 'init.php';
  if (!$currentUser)
  {
  	header('location: index1.php');
  	exit();
  }
	$posts = getNewFeeds();
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Trang Cá Nhân</title>
	<style>
		input[type=text] {width: 60%;}
		label {font-size: "2"; font-family: Times New Roman;}
		a { font-size:100%;font-weight:bold;font-family: Times New Roman;};
		.box{
        font-size: 10px;
        width:100px;
        height:100px;
        padding: 50px;
        border:10px solid black;}
        
		.textarea {
		  width: 100%;
		  height: 1200px;
		  padding: 12px 20px;
		  box-sizing: border-box;
		  border: 2px solid #ccc;
		  border-radius: 4px;
		  background-color: #f8f8f8;
		  resize: none;
		}
		.left {
       text-align: right;
    }
    .left1 {
       text-align: left;}
	</style>
</head>
<body>
	<div class="container">		
		<center><img style="width:1010px;height: 400px" class="rounded" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($currentUser[0]['anhbia']); ?>"></a></center>&emsp;&emsp;
		<img style="width:120px" class="rounded-circle" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($currentUser[0]['avatar']); ?>"><strong style = "font-family:Georgia;font-size:3"><?php echo $currentUser ? ' ' . $currentUser[0]['fullname'] . ' ' : ' ' ?></strong></a>
		<center><form action="status.php" method="POST">
		<fieldset class="box1" style="font-family:Georgia">
			<div class="left1" class="form-group">
				<label for="content"><strong>Thêm Trạng Thái</strong></label>
				<textarea class="form-control" id="content" name="content" rows="3" placeholder="<?php echo $currentUser ? '' . $currentUser[0]['fullname'] . ' ơi !' : ' ' ?>, bạn đang nghĩ gì?"></textarea>
			</div>
			<div class="left1" class="form-group">
					<i class='far fa-image' style='font-size:20px;color:dodgerblue'>&ensp;Ảnh/video</i>&emsp;<i class='fas fa-user-tag'style='font-size:20px;color:deepskyblue;'>&ensp;Gắn thẻ bạn bè</i>&emsp;<i class='far fa-grin-alt'style='font-size:20px;color:goldenrod'>&ensp;Cảm xúc/Hoạt Động</i>
					<input type="file" class="file" id="anh" name="anh">
			</div>
			<button type="Submit" class="btn btn-success"><b>Đăng</b></button>
		</fieldset>
		</form></center>

		<p class="left"><a href="updateProfile.php"><b>Cập nhật trang cá nhân</b></a></p>
		<h5 style = "font-family:Georgia;color:blue"><marquee direction="right">Không gian của <?php echo $currentUser ? ' ' . $currentUser[0]['fullname'] . ' ' : ' ' ?></marquee></h5>			
		<div class="col-sm-6">
			<div class="card"style = "font-family:Georgia;background-color:linen">
				<legend><center><strong>Giới Thiệu</strong></center></legend>
			  	<em>
				<?php
					$result = LoadData($currentUser[0]['id']);
				    echo "Biệt danh: " .' '. $result[0]['bietdanh']."<br>";
					echo "Tiểu sử : " . '  ' . $result[0]['tieusu']."<br>";
					echo "Học tại :" . '  ' . $result[0]['workplace']."<br>";
					echo "Đến từ :" . '  ' . $result[0]['quequan']."<br>";
					echo "Sống tại :" . '  ' . $result[0]['address']."<br>";
					echo "Giới tính :" . '  ' . $result[0]['gioitinh']."<br>";
					echo "Sinh nhật :" . '  ' . $result[0]['ngaysinh']."<br>";
					echo "Số điện thoại :" . '  ' . $result[0]['phonenumber']."<br>";
					?>
				</em>
			</div>
		</div>			
		<fieldset class="textarea"style = "font-family:Georgia;font-size:3">
			<legend><center><strong>Dòng thời gian</strong></center></legend>
			<?php foreach ($posts as $posts): ?>			
			<div class="col-sm-12">
				<div class="card">
			  	<div class="card-body">
			    <h5 class="card-title">
			    	<img style="width:60px;" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($posts['avatar']); ?>">
			    		    	<strong><em  style = "font-family:Georgia"><?php echo $posts['fullname']; ?></em></strong>
			    </h5>
			    <h6 class="card-subtitle mb-2 text-muted"><?php echo $posts['createAt']; ?></h6>
			    <p class="card-text">
				    	<?php echo $posts['content']; ?>    		
			    </p>
			    <i class='fa fa-thumbs-up'style='font-size:20px;color:black;'>&ensp;Thích</i>&emsp;<i class='fa fa-comment-alt'style='font-size:20px;color:black;'>&ensp;Bình Luận</i>&emsp;<i class='fa fa-share'style='font-size:20px;color:black;'>&ensp;Chia sẻ</i>
				</div>	  	
				</div>
			</div>
			<br>
			<?php endforeach ?>
		</fieldset>
	</div>
</body>
</html>
<!-- <p><iframe src="https://www.nhaccuatui.com/mh/background/dkE0hFCviG1g" width="1" height="1" frameborder="0" allowfullscreen allow="autoplay"></iframe></p> -->
<?php include 'footer.php'; ?>