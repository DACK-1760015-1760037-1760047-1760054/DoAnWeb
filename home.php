<?php 
  require_once 'init.php';
  require_once 'like_dislike.php';
  if (!$currentUser)
  {
  	header('location: index.php');
  	exit();
  }  
  $user_id = $currentUser[0]['id'];
  $Limit = 10;
  $pagenum = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
  $friendIds = findAllFriend($user_id);
  //var_dump($friendIds);exit;
  $posts = getNewFeedsWithPaging($currentUser[0]['id'],$Limit,$pagenum);
  //var_dump($posts);exit;
  $totalPage = intVal(intVal(GetTotalPageNewFeeds()[0]["total_count"])  / $Limit) + 1 ;
  
  
  error_reporting(E_ALL & ~E_NOTICE);

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if(isset($_POST['content']))
	{
		$content = $_POST['content'];
		$postid = $_POST['postid'];
		$privacy = $_POST['id_privacy'];
		header("Location:createCmt.php?content=".$content."&postid=".$postid);
	}
}

?>
<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="script_like.js"></script>
		
</head>
<body>
	<div class="container">	
    <?php if ($currentUser): ?>		
	<legend><center><strong style="font-family:Georgia">Chào mừng <?php echo $currentUser[0]['fullname']; ?> đã trở lại</strong> </center></legend>
	<div class="row">
		<div class="col-sm-3"style="margin-left:-20px;font-family:Times New Roman">
			<img style="width:40px;"alt="Cinque Terre"class="rounded-circle" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($currentUser[0]['avatar']); ?>"><strong><?php echo $currentUser ? ' ' . $currentUser[0]['fullname'] . ' ' : ' ' ?></strong>
			<br><br>		
			<div class="card">
				<a href="home.php"style="margin-left:10px;margin-top:5px;font-family:Times New Roman">
					<i style="color:dodgerblue;font-size:20px;"class='far fa-image'></i><strong style="font-size:18px;color:black;">&ensp;Bảng tin</strong>
					<div class="btn-group">
		                <div style=';color:dimgray;margin-left:120px;'class='fas fa-ellipsis-h' data-toggle="dropdown">
		                </div>
		                <div class="dropdown-menu"style = "font-family:Georgia">
		                  	<p>Tin liên quan nhất</p>
							<p>TGần đây nhất</p>
							<hr>
							<p>Chỉnh sửa tùy chọn</p>                
			            </div>
		            </div>
				</a>
			</div>
			<div class="card"style="background-color:WhiteSmoke;border:0px;">
				<a href="message.php"style="margin-left:10px;margin-top:5px;font-family:Times New Roman">
					<i style="color:dodgerblue;font-size:20px;"class='fab fa-facebook-messenger'></i><em style="ffont-size:18px;color:black;">&ensp;Messenger</em>		
				</a>
			</div>
			<div class="card"style="background-color:WhiteSmoke;border:0px;">
				<a href="https://www.facebook.com/watch/?from=bookmark"style="margin-left:10px;margin-top:5px;font-family:Times New Roman">
					<i style="color:dodgerblue;font-size:20px;"class='fas fa-desktop'></i><em style="font-size:18px;color:black;">&ensp;Watch</em>			
				</a>
			</div>
			<div class="card"style="background-color:WhiteSmoke;border:0px;">
				<a href="https://www.facebook.com/marketplace/hochiminhcity/?ref=bookmark"style="margin-left:10px;margin-top:5px;font-family:Times New Roman">
					<i style="color:forestgreen;font-size:20px;"class='fas fa-store'></i><em style="font-size:18px;color:black;">&ensp;Marketplace</em>		
				</a>
			</div>
			<br>
			<strong >Lối tắt</strong>
			<div class="card"style="background-color:WhiteSmoke;border:0px;">
				<a href="https://www.facebook.com/groups/383513698986764/?ref=bookmarks"style="margin-left:10px;margin-top:5px;font-family:Times New Roman">
					<i style="color:lightgray;font-size:20px;"class='fas fa-users'></i><em style="color:black;">&ensp;LTW1 - CD2019</em>
				</a>
			</div>
			<div class="card"style="background-color:WhiteSmoke;border:0px;">
				<a href="https://www.facebook.com/groups/960829187391758/"style="margin-left:10px;margin-top:5px;font-family:Times New Roman">
					<i style="color:grey;font-size:20px;"class='fas fa-graduation-cap'></i><em style="color:black;">&ensp;17CK1 - HCMUS</em>
				</a>
			</div>
			<div class="card"style="background-color:WhiteSmoke;border:0px;">
				<a href="https://www.facebook.com/groups/quantriCSDL17CK1/"style="margin-left:10px;margin-top:5px;font-family:Times New Roman">
					<i style="color:lightgray;font-size:20px;"class='fas fa-users'></i><em style="font-size:18px;color:black;">&ensp;QTCSDL - 17CK1</em>
				</a>
			</div>
			<div class="card"style="background-color:WhiteSmoke;border:0px;">
				<a href="https://www.facebook.com/groups/668294430347538/"style="margin-left:10px;margin-top:5px;font-family:Times New Roman">
					<i style="color:lightgray;font-size:20px;"class='fas fa-users'></i><em style="font-size:18px;color:black;">&ensp;PTUDCSDL - 2019/1</em>
				</a>
			</div>
			<div class="card"style="background-color:WhiteSmoke;border:0px;">
				<a href="https://www.facebook.com/groups/"style="margin-left:10px;margin-top:5px;font-family:Times New Roman">
					<i style="font-size:20px;"class="dropdown-toggle"></i><em style="font-size:18px;color:dodgerblue;">&ensp;Xem thêm...</em>
				</a>
			</div>
			<br>
			<strong >Khám phá</strong>
			<div class="card"style="background-color:WhiteSmoke;border:0px;">
				<a href="https://www.facebook.com/pages/?category=your_pages"style="margin-left:10px;margin-top:5px;font-family:Times New Roman">
					<i style="color:coral;font-size:20px;"class='fas fa-flag'></i><em style="color:black;">&ensp;Trang</em>
				</a>
			</div>
			<div class="card"style="background-color:WhiteSmoke;border:0px;">
				<a href="https://www.facebook.com/groups/"style="margin-left:10px;margin-top:5px;font-family:Times New Roman">
					<i style="color:dodgerblue;font-size:20px;"class='fas fa-users'></i><em style="color:black;">&ensp;Nhóm</em>
				</a>
			</div>
			<div class="card"style="background-color:WhiteSmoke;border:0px;">
				<a href="https://www.facebook.com/fundraisers/"style="margin-left:10px;margin-top:5px;font-family:Times New Roman">
					<i style="color:red;font-size:20px;"class='fas fa-heartbeat'></i><em style="font-size:18px;color:black;">&ensp;Trang gây quỹ</em>
				</a>
			</div>
			<div class="card"style="background-color:WhiteSmoke;border:0px;">
				<a href="https://www.facebook.com/events/"style="margin-left:10px;margin-top:5px;font-family:Times New Roman">
					<i style="color:orangered;font-size:20px;"class='far fa-calendar-alt'></i><em style="font-size:18px;color:black;">&ensp;Sự kiện</em>
				</a>
			</div>
			<div class="card"style="background-color:WhiteSmoke;border:0px;">
				<a href="#"style="margin-left:10px;margin-top:5px;font-family:Times New Roman">
					<i style="font-size:20px;"class="dropdown-toggle"></i><em style="font-size:18px;color:dodgerblue;">&ensp;Xem thêm...</em>
				</a>
			</div>
		</div>
		<div class="col-sm-9">
			<div class="card" style="font-family:Georgia">
				<form action="status.php" method="POST" enctype="multipart/form-data">
				    <div class="card-body"style="margin-left:-20px;margin-top:-20px;margin-right:-20px;">			    	
						<div class="form-group">							
							<textarea style="width:100%" id="content" name="content" rows="3" placeholder="<?php echo $currentUser ? '' . $currentUser[0]['fullname'] . ' ơi !' : ' ' ?>, bạn đang nghĩ gì?"></textarea>
						</div>
						<div class="btn-group"style="margin-left:20px;margin-top:-35px">
							<span class="badge badge-pill badge-light">
								<i class='far fa-image'data-toggle="tooltip" title="Thêm ảnh nào🌺"style='font-size:18px;color:dodgerblue;'>
								<strong style="color:black" data-toggle="collapse" data-target="#demo"> Ảnh/Video</strong>
								<div id="demo" class="collapse">
									<input type="file" class="file" id="img" name="img">
								</div>
								</i>
							</span>&ensp;
						</div>
						<div class="btn-group">
							<span class="badge badge-pill badge-light"style="margin-top:-30px">
								<i style='font-size:18px;color:dodgerblue;'class='fas fa-user-tag'data-toggle="tooltip" title="Ai là người bạn muốn nhắc tới❤️?"><h9 style='color:black;' data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Gắn thẻ bạn bè</h9></i>
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
							<span class="badge badge-pill badge-light"style="margin-top:-30px">
								<i style='font-size:18px;color:goldenrod;'class='fas fa-grin-alt'data-toggle="tooltip" title="Cảm xúc hiện tại của bạn😂!!"><strong style='color:black;' data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Cảm xúc/Hoạt Động</strong></i>
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
							<span class="badge badge-pill badge-light"style="margin-top:-35px">
								<strong data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i style='font-size:30px;color:dimgray'class='fas fa-ellipsis-h'></i></strong>
							</span>
						</div>
						<div class="dropdown" style="margin-bottom:-10px">											
							<select name="id_privacy" aria-labelledby="dropdownMenuButton">
								<option value="0" selected>Mọi người</option>
								<option value ="1" >Bạn bè</option>
								<option value ="2" >Chỉ mình tôi</option>
							</select>
							<button type="submit" class="btn btn-primary" name="post">Đăng</button>							
						</div>
			    	</div>
				</form>
			</div>
			<h5 style = "font-family:Georgia;color:red"><strong><marquee direction="right">Dòng thời gian của <?php echo $currentUser ? ' ' . $currentUser[0]['fullname'] . ' ' : ' ' ?> và Bạn bè</marquee></strong></h5>
			<div class="row"style="margin-top:-10px;margin-bottom:-10px;">			
				<?php foreach ($posts as $posts): ?>
				<div style = "font-family:Georgia" class="col-sm-12">
					<div class="card"style="margin-top:5px;margin-bottom:5px;">
					  	<div class="card-body"style="margin-top:-2px;margin-bottom:-25px;">
						    <h5 class="card-title">
						    	<img style="width:60px;" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($posts['avatar']); ?>">
						    		    	<strong><em  style = "font-family:Georgia"><?php echo $posts['fullname']; ?></em></strong>
											
								<div class="btn-group"style="margin-left:355px;">									
									<strong data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i style='font-size:20px' class='fas'ata-toggle="tooltip" title="Chỉnh sửa">&#xf141;</i></strong>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="#"><i class='fas'>&#xf02e;</i> Lưu bài viết</a>
										<a class="dropdown-item" href="#"><span>&#10006;</span> Ẩn bài viết</a>
										<a class="dropdown-item" href="#"><span>&#x1F552;</span> Tạm ẩn</a>
									</div>
								</div>
							</h5>
							<div class="dropdown">
						    <h6 style="margin-top:-25px;margin-left:70px;"class="card-subtitle mb-2 text-muted"><?php echo $posts['createAt']; ?>&emsp;&emsp;&emsp;
									<?php if($posts['userID'] == $currentUser[0]['id']): ?>
												
							
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
											<a class="dropdown-item" href="<?php echo "./setPrivacy?postID=".$posts['id']."&privacy=0" ?>"><i style='font-size:24px' class='fas'>&#xf57d;</i> Public</a>
											<a class="dropdown-item" href="<?php echo "./setPrivacy?postID=".$posts['id']."&privacy=1" ?>"><i style='font-size:24px' class='fas'>&#xf500;</i> Friends</a>
											<a class="dropdown-item" href="<?php echo "./setPrivacy?postID=".$posts['id']."&privacy=2" ?>"><i style='font-size:24px' class='fas'>&#xf023;</i> Only Me</a>
										</div>
									</div>
											<?php else: ?>
									<?php $number = $posts['privacy'];
																	
									switch ($number)
									{
										case 0 :
											echo "<i style='font-size:24px' class='fas'>&#xf57d;</i>";
											break;
										case 1:
											echo "<i style='font-size:24px' class='fas'>&#xf500;</i>";
											break;
										case 2:
											echo "<i style='font-size:24px' class='fas'>&#xf023</i>";
											break;
									}
									?>
									<?php endif;?>
						    </h6>
						    <p style = "font-size:20px;font-family:Times New Roman;margin-top:-5px;"class="card-text">
							    	<?php echo $posts['content']; ?>    		
							</p>
							<?php if($posts['img']) : ?>
							<div>
	                            <img style="width:100%;margin-top:-15px;" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($posts['img']); ?>">
							</div>
								<?php endif; ?>
	                        <br>
						    <div class="btn-group"style="margin-top:-15px;">
								<div class ="post">
									<div class="post-info">
									<i <?php if (userLiked($posts['id'])): ?>
												class="fa fa-thumbs-up like-btn"
												<?php else: ?>
												class="fa fa-thumbs-o-up like-btn" 
												<?php endif ?>
												
												data-id="<?php echo $posts['id'] ?>"></i>
											
												<span class="likes"><?php   echo getLikes($posts['id']); ?></span>
											
											&nbsp;&nbsp;&nbsp;&nbsp;

											<!-- if user dislikes post, style button differently -->
											<i 
												<?php if (userDisliked($posts['id'])): ?>
												class="fa fa-thumbs-down dislike-btn"
												<?php else: ?>
												class="fa fa-thumbs-o-down dislike-btn"
												<?php endif ?>
												data-id="<?php echo $posts['id'] ?>"></i>
											<span class="dislikes"><?php echo getDislikes($posts['id']); ?></span>
									</div>
								</div>&emsp;&emsp;
								<div class="btn-group">
								<form action = ""  method="POST">
									<div class ="form-group">
										<label for="content">Bình luận</label>
										<input style="display:none" type="text" name ="postid" value="<?php echo $posts['id'] ?>" >
										<textarea class="form-control" name="content" id="content" rows="1"></textarea>		
									<button type ="submit" class ="btn btn-primary">Gửi</button>
									</div>
									</form>
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
						<div class="row">
							<?php
								$comments = getCmtByPostID($posts['id']);
							 foreach ($comments as $comment): ?> 
								<div class="col-sm-12">
									<div class=""
									<div class="card">
										<h6 class="card-title">
											<img style="width:40px;margin-left:3px;" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($comment['avatar']); ?>">
							    		    <strong><em  style = "font-style: normal;"><font color="#000080"><?php echo $comment['fullname']; ?></font></em></strong>&emsp;&ensp;<?php echo $comment['content']; ?>
										</h6>										
									</div>
								</div>
							<?php endforeach ?>
						</div>	  	
					</div>
				</div>
				<?php endforeach ?>
			</div>
			<ul class="pagination justify-content-center" style="margin:30px 0">				
				<?php if($pagenum - 1 > 0) :?>
					<li class="page-item"><a class="page-link"   href="home.php?page=<?php echo $pagenum - 1; ?>">Previous</a></li>
				<?php endif;?>
				<?php if( $pagenum  < $totalPage) :?>
				<li class="page-item"><a class="page-link"   href="home.php?page=<?php echo $pagenum + 1; ?>">Next</a></li>					
				<?php endif;?>
			</ul>
			<hr>
		</div>
	<?php else: ?>
	<?php endif; ?>
</body>
</html>
<?php include 'footer.php'; ?>