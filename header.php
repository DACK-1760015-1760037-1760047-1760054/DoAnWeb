<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <title>Đồ Án _ Mạng Xã Hội</title>
    <style>
      .box1{
        font-size: 20px;
        width:600px;
        height:200px;
        padding: 10px;
        border:1px solid black;}
        .textarea {
      width: 100%;
      height: 3000px;
      padding: 12px 20px;
      box-sizing: border-box;
      border: 2px solid #ccc;
      border-radius: 4px;
      background-color: #f8f8f8;
      resize: none;}
        .left {
           text-align: justify;
        }
    </style>
  </head>
  <body>    
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-primary sticky-top"style = "padding: 0px">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div  class="collapse navbar-collapse"  id="navbarSupportedContent">
          <ul class="nav nav-tabs">            
          <?php if(!$currentUser): ?>
            <!-- Trang giới thiệu -->
            <center><h2><a class="nav-link-active"style="font-family:Georgia"><strong>LẬP TRÌNH WEB 1 _ MẠNG XÃ HỘI</strong></a></h2></center>          
            <?php else: ?>
            <!-- biểu tượng của mạng xã hội -->
            <li class="nav-item <?php echo $page == 'home' ? 'active' : ' ' ?>">
              <a class="nav-link" href="home.php" style="font-family:Georgia"><strong ><span style='font-size:25px;color:white'>&#120142;</span></strong></a>
            </li>&emsp;
            <!-- Khung tìm kiếm -->
             <nav class="navbar navbar-expand-md bg-primary navbar-primary">
            	<form action = "search.php" class="form-inline" method="POST">
	              <input class="form-control mr-sm-2" type="search" name="search-friend-box" placeholder="Tìm kiếm bạn bè..." aria-label="Search" Required>
	              <button class="btn btn-outline-success my-2 my-sm-0" name="search-btn"  type="submit">Tìm kiếm</button>
	            </form>
            </nav>&emsp;&emsp;&emsp;&nbsp;           
            <!-- Trang cá nhân -->
            <li class="nav-item <?php echo $page == 'pagePersonal' ? 'active' : ' ' ?>">
              <a class="nav-link" href="pagePersonal.php" style="font-size:95%;font-family:Georgia"><strong style="color:white"><img style="width:30px" class="rounded-circle" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($currentUser[0]['avatar']);?>"><?php echo $currentUser ? ' ' . $currentUser[0]['fullname'] . ' ' : ' ' ?></strong></a>
            <!-- Trang chủ-->
            <li class="nav-item <?php echo $page == 'home' ? 'active' : ' ' ?>">
              <a class="nav-link" href="home.php" style="font-family:Georgia"><strong style="color: white"><i class='fas fa-home' style='font-size:25px;color:black'></i>Trang chủ</strong></a>
            </li>&emsp;
            <!-- Danh sách bạn bè -->
            <li class="nav-item <?php echo $page == 'friends' ? 'active' : ' ' ?>">            
              <a class="nav-link" href="friends.php" style="font-size:95%;font-family:Georgia"><strong><i class='fas fa-user-friends' style='font-size:30px;color:black'></i></strong></a>
            </li>
            <!-- Chat -->
            <li class="nav-item <?php echo $page == 'chat' ? 'active' : ' ' ?>">            
              <a class="nav-link"href="chat.php"style="font-size:95%;font-family:Georgia"><strong><i class='fab fa-facebook-messenger'style='font-size:30px;color:black'></i></strong></a>
            </li>
            <!-- Thông báo -->
            <li class="nav-item <?php echo $page == 'thongbao' ? 'active' : ' ' ?>">            
              <a class="nav-link"href="thongbao.php"style="font-size:95%;font-family:Georgia"><strong><i class='fas fa-bell'style='font-size:30px;color:black'></i></strong></a>
            </li>
            <!-- Đăng xuất -->
            <li class="nav-item <?php echo $page == 'logout' ? 'active' : ' ' ?>">
              <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                </button>
                <div class="dropdown-menu"style = "font-family:Georgia">
                  <a class="dropdown-item" href="logout.php" ><strong>Đăng xuất <?php echo $currentUser ? '(' . $currentUser[0]['fullname'] . ')' : ' ' ?></strong></a>
                  <a class="dropdown-item" href="home.php" ><strong>Trang chủ</strong></a>
                  <a class="dropdown-item" href="updateProfile.php" ><strong>Cập nhật trang cá nhân</strong></a>
                  <a class="dropdown-item" href="changePassword.php" ><strong>Đổi mật Khẩu</strong></a>                
                </div>
              </div>
            </li>
          <?php endif; ?>       
        </div>
      </nav>