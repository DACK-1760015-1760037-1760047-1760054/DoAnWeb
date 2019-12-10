<?php 
  require_once 'init.php';
  
  $posts = getNewFeeds();
?>
<?php include 'header.php'; ?>
<?php if ($currentUser): ?>
	<div class="card">
	<fieldset class="textarea">				
	<legend><center><strong style="font-family:Georgia">Chào mừng <?php echo $currentUser[0]['fullname']; ?> đã trở lại</strong> </center></legend>
		<div class="col-sm-7">
			<div class="card"style = "font-family:Georgia;background-color:AliceBlue">
				<form action="status.php" method="POST">
					<div class="form-group">
						<label for="content"><strong>Thêm Trạng Thái</strong></label>
						<textarea class="form-control" id="content" name="content" rows="3" placeholder="<?php echo $currentUser ? '' . $currentUser[0]['fullname'] . ' ơi !' : ' ' ?>, bạn đang nghĩ gì?"></textarea>
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
			</div>
		</div>
		<h5 style = "font-family:Georgia;color:red"><strong><marquee direction="right">Dòng thời gian của <?php echo $currentUser ? ' ' . $currentUser[0]['fullname'] . ' ' : ' ' ?> và Bạn bè</marquee></strong></h5>
		<div class="row">
			<?php foreach ($posts as $posts): ?>
			<div style = "font-family:Georgia" class="col-sm-12">
				<div class="card">
				  	<div class="card-body">
					    <h5 class="card-title">
					    	<img style="width:60px;" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($posts['avatar']); ?>">
					    		    	<strong><em  style = "font-family:Georgia"><?php echo $posts['fullname']; ?></em></strong>&emsp;&emsp;&emsp;&emsp;
					    	<div class="btn-group">
								<strong data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i style='font-size:20px' class='fas'ata-toggle="tooltip" title="Chỉnh sửa">&#xf141;</i></strong>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="#"><span>&#128221;</span> Lưu bài viết</a>
									<a class="dropdown-item" href="#"><span>&#10006;</span> Ẩn bài viết</a>
									<a class="dropdown-item" href="#"><span>&#x1F552;</span> Tạm ẩn</a>
								</div>
							</div>
					    </h5>
					    <h6 class="card-subtitle mb-2 text-muted"><?php echo $posts['createAt']; ?>
					    	<div class="btn-group">
								<button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i style='font-size:15px' class='fas'data-toggle="tooltip" title="Mọi người">&#xf57d;</i></button>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="#"><i style='font-size:20px'class='fas'data-toggle="tooltip" title="Mọi người">&#xf57d;</i> Mọi người</a>
									<a class="dropdown-item" href="#"><i style='font-size:20px' class='fas'data-toggle="tooltip" title="Bạn bè">&#xf500;</i> Bạn bè</a>
									<a class="dropdown-item" href="#"><i style='font-size:20px' class="fa"data-toggle="tooltip" title="Chỉ mình tôi">&#xf023;</i> Chỉ mình tôi</a>
									<a class="dropdown-item" href="#"><i style='font-size:20px' class="fa"data-toggle="tooltip" title="Bạn bè cụ thể">&#xf007;</i> Bạn bè cụ thể</a>
								</div>
							</div>
					    </h6>
					    <p style = "font-family:Times New Roman"class="card-text">
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
			
		</div>
	</fieldset>
	<ul class="pagination justify-content-center" style="margin:30px 0">
		<li class="page-item disabled"><a class="page-link" href="#">Trước</a></li>
		 <li class="page-item"><a class="page-link" href="#">1</a></li>
		<li class="page-item"><a class="page-link" href="#">2</a></li>
		<li class="page-item"><a class="page-link" href="#">3</a></li>
		<li class="page-item"><a class="page-link" href="#">Next</a></li>
	</ul>
</div>
<?php else: ?>
<?php endif; ?>
<?php include 'footer.php'; ?>
