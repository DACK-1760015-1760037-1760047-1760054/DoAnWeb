<?php 
  require_once 'init.php';
  if (!$currentUser)
  {
  	header('location: home.php');
  	exit();
  }  	
	$userId = $_GET['id'];
	$profile = findUserById($userId);
	$posts = findAllPostOfUser($userId);

	$isFollowing = getFriendship($currentUser[0]['id'], $userId);
	$isFollower = getFriendship($userId, $currentUser[0]['id']);
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
	</style>		
</head>
<body>
	<div class="container">		
		<center><img style="width:1010px;height: 400px" class="rounded" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($profile[0]['anhbia']); ?>"></a></center>&emsp;
		<img style="width:120px" class="rounded-circle" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($profile[0]['avatar']); ?>"><strong style = "font-family:Georgia;font-size:3"><?php echo $profile ? ' ' . $profile[0]['fullname'] . ' ' : ' ' ?></strong><br>
		<?php if ($isFollowing && $isFollower): ?>
			<form>
				<div class="btn-group">
					<form method="POST" action="add-friend.php">
						<input type="hidden" id="id" name="id" value="<?php echo $_GET['id']; ?>">&emsp;
						<button type="Submit" class="btn btn-primary"><span>&#9989;Đang theo dõi</span></button>
					</form>
					<form method="POST" action="remove-friend.php">
						<input type="hidden" id="id" name="id" value="<?php echo $_GET['id']; ?>">&emsp;
						<button type="Submit" class="btn btn-primary"><span>&#10060;Xóa bạn bè</span></button>					
					</form>					
				</div>
			</form>
		<?php else: ?>
			<?php if($isFollowing && !$isFollower): ?>
				<from>
					<div class="btn-group">
						<form method="POST" action="remove-friend.php">
							<input type="hidden" id="id" name="id" value="<?php echo $_GET['id']; ?>">
							<button type="Submit" class="btn btn-primary"><span>&#10060;Xóa yêu cầu</span></button>
						</form>
						<form method="POST" action="add-friend.php">
							<input type="hidden" id="id" name="id" value="<?php echo $_GET['id']; ?>">&emsp;
							<button type="Submit" class="btn btn-primary"><span>&#9989;Theo dõi</span></button>
						</form>
					</div>
				</from>
			<?php endif; ?>
			<?php if(!$isFollowing && $isFollower): ?>
				<div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Trả lời mời kết bạn
                </button>
                <div class="dropdown-menu"style = "font-family:Georgia">
                  	<a class="dropdown-item" href="#" >
	                  	<form method="POST" action="remove-friend.php">
							<input type="hidden" id="id" name="id" value="<?php echo $_GET['id']; ?>">
							<button>Hủy yêu cầu</button>
						</form>				
                  	</a>
                  	<a class="dropdown-item" href="#" >
	                  	<form method="POST" action="add-friend.php">
							<input type="hidden" id="id" name="id" value="<?php echo $_GET['id']; ?>">
							<button>Đồng ý</button>
						</form>
                  	</a>                 
                </div>
              </div>				
			<?php endif; ?>
			<?php if(!$isFollowing && !$isFollower) : ?>
				<form method="POST" action="add-friend.php">
					<input type="hidden" id="id" name="id" value="<?php echo $_GET['id']; ?>">
					<button type="Submit" class="btn btn-primary"><i class='fa fa-user-plus' style='font-size:15px;color:black'></i><b>Thêm Bạn Bè</b></button>
				</form>
			<?php endif; ?>			
		<?php endif; ?>
		<div class="card-columns">
		    <div class="card bg-info"style="width:102%;height:325px;font-family:Times New Roman;color: white">
		      <div class="card-body">
		        <p class="card-text">
		        	<legend><center><b>Giới Thiệu</b></center></legend>
					<em><strong>
						<?php
							$result = LoadData($profile[0]['id']);
						    echo "<span>&#128140;</span>".' '."Biệt danh: " .' '. $result[0]['bietdanh']."<br>";
							echo "<span>&#128221;</span>".' '."Tiểu sử : " . '  ' . $result[0]['tieusu']."<br>";
							echo "<span>&#127891;</span>".' '."Học tại :" . '  ' . $result[0]['workplace']."<br>";
							echo "<span>&#128146;</span>".' '."Đến từ :" . '  ' . $result[0]['quequan']."<br>";
							echo "<span>&#127847;</span>".' '."Sống tại :" . '  ' . $result[0]['address']."<br>";
							echo "<span>&#9825;</span>".' '."Giới tính :" . '  ' . $result[0]['gioitinh']."<br>";
							echo "<span>&#127874;</span>".' '."Sinh nhật :" . '  ' . $result[0]['ngaysinh']."<br>";
							echo "<span>&#128222;</span>".' '."Số điện thoại :" . '  ' . $result[0]['phonenumber']."<br>";
						?>
					</em></strong>
		        </p>
		      </div>
		    </div>
		    <div class="card bg-AliceBlue" style="width:200%;height:300px;font-family:Georgia">
		    	<div class="card-body">
		        	<p class="card-text">
		        		<form action="status.php" method="POST">
							<div class="form-group">
								<label for="content"><strong>Thêm Trạng Thái</strong></label>
								<textarea class="form-control" id="content" name="content" rows="3" placeholder="<?php echo $currentUser ? '' . $currentUser[0]['fullname'] . ' ơi !' : ' ' ?>, bạn muốn viết gì cho <?php echo $profile ? '' . $profile[0]['fullname'] . ' nhỉ!' : ' ' ?>"></textarea>
								<hr>
								<div class="btn-group">
									<button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i style='font-size:24px' class='fas'data-toggle="tooltip" title="Mọi người">&#xf57d;</i></button>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="#"><i style='font-size:20px' class='fas'data-toggle="tooltip" title="Mọi người">&#xf57d;</i> Mọi người</a>
										<a class="dropdown-item" href="#"><i style='font-size:20px' class='fas'data-toggle="tooltip" title="Bạn bè">&#xf500;</i> Bạn bè</a>
										<a class="dropdown-item" href="#"><i style="font-size:20px" class="fa"data-toggle="tooltip" title="Chỉ mình tôi">&#xf023;</i> Chỉ mình tôi</a>
										<a class="dropdown-item" href="#"><i style="font-size:20px" class="fa"data-toggle="tooltip" title="Bạn bè cụ thể">&#xf007;</i> Bạn bè cụ thể</a>
									</div>
								</div>
								<div class="btn-group">
									<i class='far fa-image'data-toggle="tooltip" title="Thêm ảnh để đẹp nào🌺"style='font-size:20px;color:dodgerblue'>
									<h9 data-toggle="collapse" data-target="#demo"> Ảnh/Video</h9>
							  		<div id="demo" class="collapse">
										<input type="file" class="file" id="anh" name="anh">
							  		</div>
							  		</i>&ensp;
						  		</div>
						  		<div class="btn-group">
									<h9 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i style='font-size:20px;color:goldenrod'class='fas fa-user-tag'data-toggle="tooltip" title="Ai là người bạn muốn nhắc tới❤️?"> Gắn thẻ bạn bè</i></h9>
									<div class="dropdown-menu">
					  					<div class="input-group">
											<div class="input-group-prepend">
											    <span class="input-group-text">Với</span>
											</div>
										    <input type="text" class="form-control" placeholder="Cùng với ai?">
										</div>
									</div>	    
								</div>
								<div class="btn-group">
									<h9 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i style='font-size:20px;color:goldenrod'class='far fa-grin-alt'data-toggle="tooltip" title="Cảm xúc hiện tại của bạn😂!!"> Cảm xúc/Hoạt Động</i></h9>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="#">&#x1F601; Đang cảm thấy...</a>
										<a class="dropdown-item" href="#">&#x1F389; Đang chúc mừng...</a>
										<a class="dropdown-item" href="#">&#x1F576; Đang xem...</a>
										<a class="dropdown-item" href="#">&#x1F95E; Đang ăn...</a>
										<a class="dropdown-item" href="#">&#x1F943; Đang uống...</a>
										<a class="dropdown-item" href="#">&#x1F4C5; Đang tham gia...</a>
										<a class="dropdown-item" href="#">&#x1F6EB; Đang đi tới...</a>
									</div>
								</div>
							</div>				
							<button type="Submit" class="btn btn-success"><b>Đăng</b></button>
						</form>
					</p>
		      	</div>
		     </div>
		</div>
		<h4 style = "font-family:Georgia;color:blue"><strong><marquee direction="right">Không gian của <?php echo $profile ? ' ' . $profile[0]['fullname'] . ' ' : ' ' ?></marquee></strong></h4>
		<div class="card">				
			<fieldset class="textarea"style = "font-family:Georgia;font-size:3">
				<legend><center><strong>Dòng thời gian</strong></center></legend>
				<?php foreach ($posts as $posts): ?>			
				<div class="col-sm-12">
					<div class="card">
					  	<div class="card-body">
					    <h5 class="card-title">
					    	<img style="width:60px;" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($posts['avatar']); ?>">
					    		    	<strong><em  style = "font-family:Georgia"><?php echo $posts['fullname']; ?></em></strong>&emsp;&emsp;&emsp;&emsp;
					    	<div class="btn-group">
								<strong data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i style='font-size:20px' class='fas'ata-toggle="tooltip" title="Chỉnh sửa">&#xf141;</i></strong>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="#"><span>&#128221;</span> Lưu bài viết</a>
									<hr>
									<a class="dropdown-item" href="#"> Nhúng</a>
									<a class="dropdown-item" href="#"> Bật thông báo cho bài biết này</a>
									<hr>
									<a class="dropdown-item" href="#"> Tìm hỗ trợ hoặc báo cáo cho bài viết</a>
								</div>
							</div>
					    </h5>
					    <h6 class="card-subtitle mb-2 text-muted"><?php echo $posts['createAt']; ?>&ensp;
					    	<div class="btn-group">
								<h9 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i style='font-size:15px' class='fas'data-toggle="tooltip" title="Mọi người">&#xf57d;</i></h9>								
							</div>
					    </h6>
					    <p class="card-text">
						    	<?php echo $posts['content']; ?>    		
					    </p>
					    <div class="btn-group">
									<div class="btn-group">
										<h9 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i style='font-size:20px' class='far fa-thumbs-up'data-toggle="tooltip" title="Cảm xúc của bạn với status này!!"></i> Thích</h9>
										<div class="dropdown-menu">
											<a class="dropdown-item" href="#"><span style='font-size:20px';>&#x1F44D; &#x1F496; &#x1F606; &#x1F62F; &#x1F630; &#x1F621;</span></a>
										</div>
									</div>&emsp;&emsp;
									<div class="btn-group">
										<h9 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i style='font-size:20px' class='far fa-comment-alt'data-toggle="tooltip" title="Cảm nghĩ của bạn về bài viết này!"></i> Bình luận</h9>
										<div class="dropdown-menu">
											<img style="width:20px" class="rounded-circle" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($currentUser[0]['avatar']); ?>">
							  				<input class="form-control" id="comment" placeholder="Thêm bình luận..." name="comment">
										</div>
									</div>&emsp;&emsp;
					  				<div class="btn-group">
										<h9 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i style='font-size:20px' class='fa fa-share'data-toggle="tooltip" title="Chia sẻ với bạn bè"></i> Chia sẻ </h9>
										<div class="dropdown-menu">
											<a class="dropdown-item" href="#">Chia sẻ ngay (Công khai)</a>
											<a class="dropdown-item" href="#">Chia sẻ ...</a>
											<a class="dropdown-item" href="#">Gửi dưới dạng tin nhắn</a>
											<a class="dropdown-item" href="#">Chia sẻ trên dòng thời gian với bạn bè</a>
											<a class="dropdown-item" href="#">Chia sẻ lên trang</a>
										</div>
									</div>
					  			</div>
						 	</div>	  	
						</div>
					</div>
				<?php endforeach ?>
			</fieldset>
		</div>
		<ul class="pagination justify-content-center" style="margin:30px 0">
		<li class="page-item disabled"><a class="page-link" href="#">Trước</a></li>
		 <li class="page-item"><a class="page-link" href="#">1</a></li>
		<li class="page-item"><a class="page-link" href="#">2</a></li>
		<li class="page-item"><a class="page-link" href="#">3</a></li>
		<li class="page-item"><a class="page-link" href="#">Next</a></li>
		</ul>
	</div>
</body>
</html>
<!-- <p><iframe src="https://www.nhaccuatui.com/mh/background/dkE0hFCviG1g" width="1" height="1" frameborder="0" allowfullscreen allow="autoplay"></iframe></p> -->
<?php include 'footer.php'; ?>