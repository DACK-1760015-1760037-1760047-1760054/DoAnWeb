<?php 
  require_once 'init.php';
  
  $posts = getNewFeeds();
?>
<?php include 'header.php'; ?>
<?php if ($currentUser): ?>
<fieldset class="textarea">				
<legend><center><strong style="font-family:Georgia">Chào mừng <?php echo $currentUser[0]['fullname']; ?> đã trở lại</strong> </center></legend>
	<form action="status.php" method="POST">
		<fieldset class="box1" style="font-family:Georgia">
			<div class="form-group">
				<label for="content"><strong>Thêm Trạng Thái</strong></label>
				<textarea class="form-control" id="content" name="content" rows="3" placeholder="<?php echo $currentUser ? '' . $currentUser[0]['fullname'] . ' ơi !' : ' ' ?>, bạn đang nghĩ gì?"></textarea>
			</div>
			<div class="form-group">
					<i class='far fa-image' style='font-size:20px;color:dodgerblue'>&ensp;Ảnh/video</i>&emsp;<i class='fas fa-user-tag'style='font-size:20px;color:deepskyblue;'>&ensp;Gắn thẻ bạn bè</i>&emsp;<i class='far fa-grin-alt'style='font-size:20px;color:goldenrod'>&ensp;Cảm xúc/Hoạt Động</i>
					<input type="file" class="file" id="anh" name="anh">
			</div>
			<button type="Submit" class="btn btn-success"><b>Đăng</b></button>
		</fieldset>
		<br><br>
	</form>
	<div class="row">
		<?php foreach ($posts as $posts): ?>
		<div style = "font-family:Georgia" class="col-sm-12">
				<div class="card">
			  	<div class="card-body">
			    <h5 class="card-title">
			    	<img style="width:60px;" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($posts['avatar']); ?>">
		    		    	<strong><em  style = "font-family:Georgia"><?php echo $posts['fullname']; ?></em></strong>
			    </h5>
			    <h6 class="card-subtitle mb-2 text-muted"><?php echo $posts['createAt']; ?></h6>
			    <p style = "font-family:Times New Roman"class="card-text">
			    	<?php echo $posts['content']; ?>    		
			    </p>			    
			    <i class='far fa-thumbs-up'style='font-size:20px;color:black;'>&ensp;Thích</i>&emsp;<i class='far fa-comment-alt'style='font-size:20px;color:black;'>&ensp;Bình Luận</i>&emsp;<i class='fa fa-share'style='font-size:20px;color:black;'>&ensp;Chia sẻ</i>
			  	</div>	  	
				</div>
		</div>
		<?php endforeach ?>
	</div>
</fieldset>
<?php else: ?>
<?php endif; ?>
<?php include 'footer.php'; ?>
