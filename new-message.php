<?php
require_once 'init.php';
if (isset($_POST['userId']) && isset($_POST['content'])) {
  sendMessage($currentUser[0]['id'], $_POST['userId'], $_POST['content']);
  header('Location: conversation.php?id=' . $_POST['userId']);
}
$friends = getUser();

?>
 
<?php include 'header.php' ?>
<fieldset class="textarea" style = "font-size:20px;font-family:Times New Roman;">
  <legend><center><h2>Tin Nhắn Mới</h2></center></legend>
  <form method="POST">
  <div class="form-group">
    <label for="userId">Tới</label>
    <select class="form-control" id="userId" name="userId">
      <?php foreach($friends as $friend) : ?>
      <option value="<?php echo $friend['id'] ?>"><?php echo $friend['fullname'] ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group"style="margin-bottom:-5px;">
    <label for="content">Tin nhắn:</label>
    <span class="badge badge-pill badge-light"style="width:100%">
      <textarea class="form-control" id="content" name="content" rows="1" placeholder="Gửi những lời tốt đẹp đến người ấy💖 "></textarea>
    </span>    
  </div>  
  <div class="form-group"align="right" style="margin-bottom:-10px;margin-left:10px;">  
  <button type="submit" class="btn btn-primary">Gửi tin nhắn</button>
  </div>
</form>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      if(isset($_POST['content']))
      {
        $td = 'Bạn nhận được tin nhắn từ '.$currentUser[0]['fullname'].' ';
        $nd = $currentUser[0]['fullname'].' đã gửi cho bạn tin nhắn. Nội dung tin nhắn: '.$_POST['content'].'';
        sendEmail($friend['email'], $friend['fullname'], $td, $nd);
      }
    }
  
      ?>
</fieldset>

<hr>
<?php include 'footer.php' ?>