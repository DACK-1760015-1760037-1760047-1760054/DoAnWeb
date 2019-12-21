<?php
require_once 'init.php';
require_once 'like_dislike.php';
$user_id = $currentUser[0]['id'];
$result = LoadData($currentUser[0]['id']);
if (!$currentUser) {
	header('location: home.php');
	exit();
}
$Limit = 10;
$pagenum = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$posts = getNewFeedsWithPagingUser($currentUser[0]['id'], $Limit, $pagenum);
$totalPage = intVal(intVal(GetTotalPageNewFeedsUser($currentUser[0]['id'])[0]["total_count"])  / $Limit) + 1;
error_reporting(E_ALL & ~E_NOTICE);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['content'])) {
		$content = $_POST['content'];
		$postid = $_POST['postid'];

		header("Location:createCmt.php?content=" . $content . "&postid=" . $postid);
	}
}

?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Trang Cá Nhân</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="script_like.js"></script>
	<style>
		label {
			font-size: "2";
			font-family: Times New Roman;
		}

		a {
			font-size: 100%;
			font-weight: bold;
			font-family: Times New Roman;
		}

		;
	</style>
</head>

<body>
	<div class="container">
		<div class="card">
			<div class="card-text">
				<div class="card-title">
					<img style="width:100%;height: 500px" class="rounded" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($currentUser[0]['anhbia']); ?>">
					<div class="card-text" style="font-family:Geogia;margin-top:-160px">
						<img style="width:200px;margin-left:20px;" alt="Cinque Terre" class="rounded-circle" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($currentUser[0]['avatar']); ?>"><strong style="color:GhostWhite;font-size:20px;"><?php echo $currentUser ? ' ' . $currentUser[0]['fullname'] . ' ' : ' ' ?></strong>
						<button style="margin-left:40%;"><a href="updateProfile.php" data-toggle="tooltip" title="Chỉnh sửa thông tin của bạn"><span style="color:dimgray;" class='fas'>&#xf304; Cập Nhật Trang Cá Nhân</span></a></button>
					</div>
				</div>
				<div class="card-title" style="font-family:Times New Roman;color:blue;margin-top:-50px;margin-left:25%;">
					<div class="col-12">
						<strong>Dòng thời gian <i class='fas'>&#xf0d7;</i></strong>&emsp;&emsp;&emsp;
						<strong>Giới thiệu </strong>&emsp;&emsp;&emsp;
						<strong>Bạn bè <i class='fas'>&#xf500;</i></strong>&emsp;&emsp;&emsp;
						<strong>Ảnh</strong>&emsp;&emsp;&emsp;
						<strong class='fas'>&#xf023; Lưu trữ</strong>&emsp;&emsp;&emsp;
						<strong>Xem thêm <i class='fas'>&#xf0d7;</i></strong>
					</div>
					<div class="col-12">
						<p></p>
					</div>
				</div>
			</div>
		</div><br>
		<div class="row">
			<div class="col-sm-4">
				<div class="card">
					<div class="card-body" style="font-size:15px;font-family:Times New Roman;">
						<div class="card-text">
							<i style='margin-top:3px;color: black;' class='fas' data-toggle="tooltip" title="Mọi người">&#xf57d;&ensp;Giới thiệu</i><br><br>
							<em><strong>
									<center>
										<div class="card-title">
											<?php
											echo $result[0]['tieusu'] . '💖';
											?><br>
											<button class="form-control"><b>Chỉnh sửa tiểu sử</b></button>
										</div>
									</center>
									<hr>
									<?php
									echo "<i style='font-size:15px;color:gray;'class='far'>&#xf2c1;</i>" . '&ensp;' . "Biệt danh: " . ' ' . $result[0]['bietdanh'] . "<br>";
									echo "<i style='font-size:15px;color:gray;'class='fas'>&#xf19d;</i>" . '&ensp;' . "Học tại :" . '  ' . $result[0]['workplace'] . "<br>";
									echo "<i style='font-size:15px;color:gray;'class='fas'>&#xf6f1;</i>" . '&ensp;' . "Đến từ :" . '  ' . $result[0]['quequan'] . "<br>";
									echo "<i style='font-size:15px;color:gray;'class='fab'>&#xf3da;</i>" . '&ensp;' . "Sống tại :" . '  ' . $result[0]['address'] . "<br>";
									echo "<i style='font-size:15px;color:gray;'class='fas'>&#xf004;</i>" . '&ensp;' . "Giới tính :" . '  ' . $result[0]['gioitinh'] . "<br>";
									echo "<i style='font-size:15px;color:gray;'class='fas'>&#xf1fd;</i>" . '&ensp;' . "Sinh nhật :" . '  ' . $result[0]['ngaysinh'] . "<br>";
									echo "<i style='font-size:15px;color:gray;'class='fas'>&#xf095;</i>" . '&ensp;' . "Số điện thoại :" . '  ' . $result[0]['phonenumber'] . "<br>";
									?>
								</strong></em><br>
							<a href="updateProfile.php"><button class="form-control"><b>Chỉnh sửa chi tiết</b></button></a><br>
							<div class="card-columns" style="margin-left:-14px;">
								<div class="card">
									<img style="height:100px;width:100px;" class="rounded" src="http://media.doisongphapluat.com/470/2016/5/30/em-be-thien-than.jpg">
								</div>
								<div class="card">
									<img style="height:100px;width:100px;" class="rounded" src="https://www.kidsplaza.vn/blog/wp-content/uploads/2018/11/dat-ten-hay-cho-be.jpg">
								</div>
								<div class="card">
									<img style="height:100px;width:100px;" class="rounded" src="https://linkhay2.vcmedia.vn/upload/editor/157567.OTX675a0c116ce99f7.jpg">
								</div>
								<div class="card">
									<img style="height:100px;width:100px;" class="rounded" src="https://ttol.vietnamnetjsc.vn/images/2018/12/04/14/28/chi-em-be-gai-hai-duong-xinh-dep-4.jpg">
								</div>
								<div class="card">
									<img style="height:100px;width:100px;" class="rounded" src="https://anhvienmimosa.com/wp-content/uploads/2019/04/top-3-studio-chup-anh-cho-dep-o-ha-dong-1.jpg">
								</div>
								<div class="card">
									<img style="height:100px;width:100px;" class="rounded" src="http://mediaold.tiin.vn:8080/media_old_2016//archive/images/2017/04/25/193405_min_4602.jpg">
								</div>
								<div class="card">
									<img style="height:100px;width:100px;" class="rounded" src="https://image.giaoducthoidai.vn/168x110/uploaded/tranghn/2018-05-26/net-cuoi-be-gai-9-1527053440039156820618-ykxt.jpg">
								</div>
								<div class="card">
									<img style="height:100px;width:100px;" class="rounded" src="http://mediaold.tiin.vn:8080/media_old_2016//archive/images/2017/03/07/160830_5.jpg">
								</div>
								<div class="card">
									<img style="height:100px;width:100px;" class="rounded" src="https://media.ex-cdn.com/EXP/media.giadinhmoi.vn/files/danggiang/2018/04/06/hinh-anh-em-be-ngo-nghinh-de-thuong-nhat-9-0935.jpg">
								</div>
							</div>
							<button class="form-control"><b>Chỉnh sửa mục đáng chú ý</b></button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-8">
				<div class="card" style="font-family:Georgia">
					<div class="card-body">
						<div class="card-text">
							<div class="card">
								<form action="status.php" method="POST" enctype="multipart/form-data">
									<div class="card-header">
										<p style="font-family:Times New Roman;margin-top:-1px;margin-bottom:-5px;">
											<strong><i style="color:black" class='fas'>&#xf303; <b>Tạo bài viết</b></i></strong>&emsp;&ensp;
											<strong><i style="color:black" class="fas">&#xf030; <b>Ảnh/Video</b></i></strong>&emsp;&emsp;&ensp;
											<strong><i style="color:black" class="fa">&#xf03d; <b>Video trực tiếp</b></i></strong>&emsp;&emsp;&ensp;
											<strong><i style='color:black' class="fa">&#xf024; <b>Sự kiện trong đời</b></i></strong>
										</p>
									</div>
									<div class="card-body" style="margin-left:-20px;margin-top:-20px;margin-right:-20px;">
										<div class="form-group">
											<textarea style="width:100%" id="content" name="content" rows="3" placeholder="<?php echo $currentUser ? '' . $currentUser[0]['fullname'] . ' ơi !' : ' ' ?>, bạn đang nghĩ gì?"></textarea>
										</div>
										<div class="btn-group" style="margin-left:20px;margin-top:-20px">
											<span class="badge badge-pill badge-light">
												<i class='far fa-image' data-toggle="tooltip" title="Thêm ảnh nào🌺" style='font-size:18px;color:dodgerblue;'>
													<strong style="color:black" data-toggle="collapse" data-target="#demo"> Ảnh/Video</strong>
													<div id="demo" class="collapse">
														<input type="file" class="file" id="img" name="img">
													</div>
												</i>
											</span>&ensp;
										</div>
										<div class="btn-group">
											<span class="badge badge-pill badge-light" style="margin-top:-20px">
												<i style='font-size:18px;color:dodgerblue;' class='fas fa-user-tag' data-toggle="tooltip" title="Ai là người bạn muốn nhắc tới❤️?">
													<h9 style='color:black;' data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Gắn thẻ bạn bè</h9>
												</i>
												<div class="dropdown-menu">
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text">Với</span>
														</div>
														<input type="text" class="form-control" placeholder="Cùng với ai?">
													</div>
												</div>
											</span>
										</div>
										<div class="btn-group">
											<span class="badge badge-pill badge-light" style="margin-top:-20px">
												<i style='font-size:18px;color:goldenrod;' class='fas fa-grin-alt' data-toggle="tooltip" title="Cảm xúc hiện tại của bạn😂!!"><strong style='color:black;' data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Cảm xúc/Hoạt Động</strong></i>
												<div class="dropdown-menu">
													<a class="dropdown-item" href="#">&#x1F601; Đang cảm thấy...</a>
													<a class="dropdown-item" href="#">&#x1F389; Đang chúc mừng...</a>
													<a class="dropdown-item" href="#">&#x1F576; Đang xem...</a>
													<a class="dropdown-item" href="#">&#x1F95E; Đang ăn...</a>
													<a class="dropdown-item" href="#">&#x1F943; Đang uống...</a>
													<a class="dropdown-item" href="#">&#x1F4C5; Đang tham gia...</a>
													<a class="dropdown-item" href="#">&#x1F6EB; Đang đi tới...</a>
												</div>
											</span>
										</div>
										<div class="btn-group">
											<span class="badge badge-pill badge-light" style="margin-top:-20px">
												<strong data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i style='font-size:20px;color:dimgray' class='fas fa-ellipsis-h'></i></strong>
											</span>
										</div>

										<div class="dropdown" style="margin-bottom:-10px">
											<select name="id_privacy" aria-labelledby="dropdownMenuButton">
												<option value="0" selected>Mọi người</option>
												<option value="1">Bạn bè</option>
												<option value="2">Chỉ mình tôi</option>
											</select>
											<button type="submit" class="btn btn-primary" name="post">Đăng</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<p style="font-family:Times New Roman;margin-left:50px;margin-top:10px;margin-bottom:-5px;margin-right:-50px;">
					<strong>Bài viết</strong>&emsp;&ensp;
					<button class="form-group"><i style="color:black" class="fa">&#xf233; <b>Quản lý bài viết</b></i></button>&emsp;&emsp;&ensp;
					<button class="form-group"><i class='fas'>&#xf0c9; <b>Chế độ xem danh sách</b></i></button>
					<button class="form-group"><i style='color:black' class='fas'>&#xf009; <b>Chế độ xem lưới</b></i></button>
				</p>
				<div class="card" style="font-family:Georgia">
					<h4 style="color:blue"><strong>
							<marquee direction="right">Không gian của <?php echo $currentUser ? ' ' . $currentUser[0]['fullname'] . ' ' : ' ' ?></marquee>
						</strong></h4>
					<?php foreach ($posts as $posts) : ?>
						<div class="card" style="margin-top:5px">
							<div class="card-body">
								<h5 class="card-title">
									<img style="width:60px;" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($posts['avatar']); ?>"><strong><em><?php echo $posts['fullname']; ?></em></strong>&emsp;&emsp;&emsp;&emsp;

									<div class="text-right" class="btn-group" style="margin-top:-30px;">
										<strong data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i style='font-size:20px' class='fas' ata-toggle="tooltip" title="Chỉnh sửa">&#xf141;</i></strong>
										<div class="dropdown-menu">
											<a class="dropdown-item" href="#"><i class='fas'>&#xf02e;</i> Lưu bài viết</a>
											<hr>
											<a class="dropdown-item" href="#"> Chỉnh sửa bài viết</a>
											<a class="dropdown-item" href="#"> Nhúng</a>
											<a class="dropdown-item" href="#"> Tắt thông báo cho bài biết này</a>
											<hr>
											<a class="dropdown-item" href="#"> Ẩn khỏi dòng thời gian</a>
											<a class="dropdown-item" href="#"> Tắt bản dịch</a>
											<a class="dropdown-item" href="#"> Kiểm duyệt bình luận</a>
										</div>
									</div>
								</h5>
								<div class="dropdown">
								<h6 style="margin-top:-30px;margin-left:70px;" class="card-subtitle mb-2 text-muted"><?php echo $posts['createAt']; ?>&ensp;
								
										<a style="background: transparent; border:none" class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<?php $number = $posts['privacy'];
											if ($number == 0) :
											?>
												<i style='font-size:24px' class='fas'>&#xf57d;</i>
											<?php elseif ($number  == 1) : ?>
												<i style='font-size:24px' class='fas'>&#xf500;</i>
											<?php elseif ($number  == 2) : ?>
												<i style='font-size:24px' class='fas'>&#xf023;</i>
											<?php endif; ?>
										</a>

										<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<a class="dropdown-item" href="<?php echo "setPrivacy.php?postID=".$posts['id']."&privacy=0&for=pagePersonal.php" ?>"><i style='font-size:24px' class='fas'>&#xf57d;</i> Public</a>
											<a class="dropdown-item" href="<?php echo "setPrivacy.php?postID=".$posts['id']."&privacy=1&for=pagePersonal.php" ?>"><i style='font-size:24px' class='fas'>&#xf500;</i> Friends</a>
											<a class="dropdown-item" href="<?php echo "setPrivacy.php?postID=".$posts['id']."&privacy=2&for=pagePersonal.php" ?>"><i style='font-size:24px' class='fas'>&#xf023;</i> Only Me</a>
										</div>
									</div>
									<!-- <?php $number = $posts['privacy'];
											

											switch ($number) {
												case 0:
													echo "<i style='font-size:24px' class='fas'>&#xf57d;</i>"; // public nó á
													break;
												case 1:
													echo "<i style='font-size:24px' class='fas'>&#xf500;</i>"; // bb
													break;
												case 2:
													echo "<i style='font-size:24px' class='fas'>&#xf023</i>"; //chỉ mình tôi
													break;
											}
											?> -->
								</h6>
								
								<p style="font-size:20px;font-family:Times New Roman;margin-top:-5px;" class="card-text">
									<?php echo $posts['content']; ?>
								</p>
								<div>
									<img style="width:100%;margin-top:-15px;" style="width:100%;max-height:500px;" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($posts['img']); ?>">
								</div>
								<br>
								<div class="btn-group" style="margin-top:-15px;">
									<div class="post">
										<div class="post-info">
											<i <?php if (userLiked($posts['id'])) : ?> class="fa fa-thumbs-up like-btn" <?php else : ?> class="fa fa-thumbs-o-up like-btn" <?php endif ?> data-id="<?php echo $posts['id'] ?>">
											</i>
											<span class="likes"><?php echo getLikes($posts['id']); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
											<!-- if user dislikes post, style button differently -->
											<i <?php if (userDisliked($posts['id'])) : ?> class="fa fa-thumbs-down dislike-btn" <?php else : ?> class="fa fa-thumbs-o-down dislike-btn" <?php endif ?> data-id="<?php echo $posts['id'] ?>">
											</i>
											<span class="dislikes"><?php echo getDislikes($posts['id']); ?></span>
										</div>
									</div>&emsp;&emsp;
									<div class="btn-group">
										<form action="" method="POST">
											<div class="form-group">
												<label for="content">Bình luận</label>
												<input style="display:none" type="text" name="postid" value="<?php echo $posts['id'] ?>">
												<textarea class="form-control" name="content" id="content" rows="1"></textarea>
												<button type="submit" class="btn btn-primary">Gửi</button>
											</div>
										</form>
									</div>&emsp;&emsp;
									<div class="btn-group">
										<h9 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i style='font-size:20px' class='fa fa-share' data-toggle="tooltip" title="Chia sẻ với bạn bè"></i> Chia sẻ </h9>
										<div class="dropdown-menu">
											<a class="dropdown-item" href="#">Chia sẻ ngay (Công khai)</a>
											<a class="dropdown-item" href="#">Chia sẻ ...</a>
											<a class="dropdown-item" href="#">Gửi dưới dạng tin nhắn</a>
											<a class="dropdown-item" href="#">Chia sẻ trên dòng thời gian với bạn bè</a>
											<a class="dropdown-item" href="#">Chia sẻ lên trang</a>
										</div>
									</div>
								</div>
								<div class="row">
									<?php
									$comments = getCmtByPostID($posts['id']);
									foreach ($comments as $comment) : ?>
										<div class="col-sm-12">
											<div class="" <div class="card">
												<h6 class="card-title">
													<img style="width:40px;" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($comment['avatar']); ?>">
													<strong><em style="font-style: normal;">
															<font color="#000080"><?php echo $comment['fullname']; ?></font>
														</em></strong>&emsp;&emsp;<?php echo $comment['content']; ?>
												</h6>

											</div>
										</div>
									<?php endforeach ?>
								</div>
							</div>
						</div>
					<?php endforeach ?>
					<ul class="pagination justify-content-center" style="margin:30px 0">
						<?php if ($pagenum - 1 > 0) : ?>
							<li class="page-item"><a class="page-link" href="pagePersonal.php?page=<?php echo $pagenum - 1; ?>">Previous</a></li>
						<?php endif; ?>
						<?php if ($pagenum  < $totalPage) : ?>
							<li class="page-item"><a class="page-link" href="pagePersonal.php?page=<?php echo $pagenum + 1; ?>">Next</a></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
<hr>
<?php include 'footer.php'; ?>