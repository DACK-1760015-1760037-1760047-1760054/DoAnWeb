
<?php
require_once 'init.php';
if (isset($_POST['content'])) {
  sendMessage($currentUser[0]['id'], $_GET['id'], $_POST['content']); 
}

$messages = getMessagesWithUserId($currentUser[0]['id'], $_GET['id']);
$user = findUserById($_GET['id']);
if(isset($_POST['currentMessage']))
{
  deleteMessageWithId($_POST['currentMessage']);
  header('Location: conversation.php?id=' . $_GET['id']);
}
?>
<?php include 'header.php' ?>
<fieldset class="textarea" style = "font-family:Times New Roman;margin-left:50px;font-size:20px;">
  <legend><center><h1 style = "color:blue">Cuộc trò chuyện với: <?php echo $user[0]['fullname'] ?></h1></center></legend>
    <form action = ""  method="POST">
      <?php foreach ($messages as $message) : ?>
        <div class="form-group"style="margin-top:0px;margin-bottom:0px;">
          <?php if ($message['type'] == 1) : ?>        
            <span class="badge badge-pill badge-info"style="padding-right:15px;">
                <strong><?php echo $user[0]['fullname'] ?></strong>:
                <?php echo $message['content'] ?><a href="" .$conversation['id']></a>&emsp;
                <button style="font-size:1px;" type="submit" id="currentMessage" name="currentMessage" class="btn btn-danger" value="<?php echo $message['id']; ?>"><i style="font-size:10px;"class='fas'> &#xf2ed;</i></button>
            </span>            
            <?php else: ?>
              <div class="card-text text-right">
                <span class="badge badge-pill badge-primary" style="padding-right:15px;">
                  <?php echo $message['content'] ?>&emsp;
                  <button style="font-size:1px;" type="submit" id="currentMessage" name="currentMessage" class="btn btn-danger" value="<?php echo $message['id']; ?>"><i style="font-size:10px;"class='fas'> &#xf2ed;</i></button>
                </span>
              </div>
            <?php endif; ?>
          </div>
      <?php endforeach; ?>
    </form>
    <br><br>
    <form method="POST">
      <div class="card-text text-center">
        <div class="form-group">      
          <img style="width:50px;margin-top:-30px;"class="rounded-circle" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($currentUser[0]['avatar']); ?>">&ensp;
          <textarea style="width:40%;height:40px;border:1px solid grey;"id="content" name="content"placeholder="Nhập tin nhắn..."></textarea>
          <div class="form-group"align="right" style="margin-top:-46px;margin-bottom:-13px;margin-right:150px;">  
            <button type="submit" class="btn btn-primary">Gửi</button>
          </div>
        </div>       
      </div>           
    </form>
    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      if(isset($_POST['content']))
      {
        $td = 'Bạn nhận được tin nhắn từ '.$currentUser[0]['fullname'].' ';
        $nd = $currentUser[0]['fullname'].' đã gửi cho bạn tin nhắn. Nội dung tin nhắn: '.$message['content'].'';
        sendEmail($user[0]['email'], $user[0]['fullname'], $td, $nd);
      }
    }
  
    ?>
</fieldset> 
<hr>
<?php include 'footer.php' ?>