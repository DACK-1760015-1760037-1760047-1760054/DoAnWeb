<?php 
  require_once 'init.php';
  require_once 'function.php';

  $name = $_POST['search-friend-box'];
  $peoples = searchFriendByName($name);
  if(!$currentUser)
  {
    header('Location: home.php');
    exit();
  } 
?>
<?php include 'header.php'; ?>
<br><br><br><br>
<?php if(empty($peoples) ):?>
<div style="text-align: center;">
     <h4>Không có kết quả tìm kiếm cho '<?php echo $name;?>'</h4>
</div>
<?php else: ?>
<div style="text-align: center;">
    <h4>Kết quả tìm kiếm cho '<?php echo $name;?>'</h4>    
</div>
  <?php if(empty($peoples)==false):?>
  <div class="card" style="width: 80%; margin: 0 auto; border: none;"><h4>Mọi người</h4></div>
  <?php endif;?>
  <?php foreach ($peoples as $people ) : ?>
     <div class="card" style="width: 80%; margin: 0 auto; ">
      <div class="card-body">     
        <div class="row">
          <div class="col-10">
            <a href ="profile.php?id=<?php echo $people['id'];?>" >
		          <img style="width:120px" class="rounded-circle" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($people['avatar']); ?>"><strong style = "font-family:Georgia;font-size:3"><?php echo $peoples? ' ' . $peoples[0]['fullname'] . ' ' : ' ' ?></strong><br>
            </a>
            <a href ="friends.php?id=<?php echo $people['id'];?>" >Xem danh sách Friend</a>
          </div>              
        </div>           
      </div>
    </div>  
  <?php endforeach; ?>
<?php endif;?>
<hr>
<?php include 'footer.php'; ?>