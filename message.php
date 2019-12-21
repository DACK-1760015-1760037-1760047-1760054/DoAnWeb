<?php
require_once 'init.php';
$conversations = getLatestConversations($currentUser[0]['id']);

if(isset($_POST['deleteall']))
{
  deleteAllMessageWithId($currentUser[0]['id'], $_POST['deleteall']);
  header('Location: message.php');
}
?>
<?php include 'header.php' ?>
<div class="container">
  <fieldset class="textarea"style="margin-left:50px;">
    <legend style="font-family: georgia;"><center><strong><marquee direction="right">Messenger của <?php echo $currentUser ? ' ' . $currentUser[0]['fullname'] . ' ' : ' ' ?></marquee></strong></center></legend>
    <div class="card"style="border: 0px solid gray;margin-top:-5px;">
    <div class="card-header"style="font-family:Times New Roman;">
      <strong>Gần đây</strong>&ensp;
      <strong style="color:lightgray">Tin nhắn đang chờ</strong>
      <strong style="color:dodgerblue;margin-left:45%;"><i class='fas'>&#xf0c0;</i> Nhóm mới</strong>&ensp;
      <a href="new-message.php"role="button" aria-pressed="true"><i class='fas'>&#xf7f5;</i> Cuộc trò chuyện mới</a>
    </div>
    <div class="card-body">
      <?php foreach ($conversations as $conversation) : ?>
    <div class="card"style="border: 0.5px solid crimson;">
      <div class="card-body"style="margin-bottom:-20px;">
        <h4 class="card-title"style="margin-bottom:-45px;margin-left:5px">
          <div class="row">
            <div class="col">
              <?php if ($conversation['avatar']) : ?>
                <img style="width:50px;" class="img-thumbnail" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($conversation['avatar']); ?>">
                <a style="font-family:Courier New;" href="conversation.php?id=<?php echo $conversation['id'] ?>"><strong><?php echo $conversation['fullname'] ?></strong></a>
                <a href="" .$conversation['id']></a>
                <form method="POST">
                <p align="right"><button type="submit" class="btn btn-danger" name="deleteall" value="<?php echo $conversation['id']; ?>"><i class='fas'>&#xf2ed;</i></button></p>
              </form>
              <?php else : ?>
              <img class="avatar" src="no-avatar.jpg">
              <?php endif; ?>
            </div>
          </div>
        </h4>
        <p class="card-text"style="margin-bottom:-5px;margin-left:20px">
          <small style="font-family:Arial;font-size:10px">Tin nhắn cuối vào lúc: <?php echo $conversation['lastMessage']['createdAt'] ?></small>
          <p style="font-family:Times New Roman;font-size:20px;margin-left:20px">Nội dung: <?php echo $conversation['lastMessage']['content'] ?></p>
        </p>
      </div>
    </div>
    <?php endforeach; ?>
    </div>
    <div class="card-footer">
      <center><strong style="font-family: georgia;font-size:5;color:magenta;">Dù đi tới chân trời trong lòng vẫn mãi vấn vương ♥️</strong></center>
    </div>
  </div>  
  </fieldset>
</div>
<hr>
<?php include 'footer.php' ?>