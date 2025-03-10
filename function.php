<?php

require_once('./vendor/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function setPrivacy($postID,$privacy)
{
	$sql ="UPDATE posts SET privacy = ? where id = ?";
	global $db;
	$stmt = $db->prepare($sql);
	$stmt->execute([$privacy,$postID]);
	
}

function detectPage(){
	$uri = $_SERVER ['REQUEST_URI'];
	$parts = explode('/', $uri);
	$fileName = $parts[2];
	$parts = explode('.',$fileName);
	$page = $parts[0];
	return $page;
}

function findUserByEmail($email)
{
	global $db;
	$stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
	$stmt->execute(array($email));
	return $stmt -> fetchAll(PDO::FETCH_ASSOC);
}
function FindIDUserByEmail($Email)
{
	global $db;
	$stmt = $db->prepare("SELECT * FROM users U WHERE U.email = ?");
	$stmt->execute(array($Email));
	$ID = $stmt -> fetchAll(PDO::FETCH_ASSOC);
	return $ID[0]['id'];

}
function findUserById($id)
{
	global $db;
	$stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
	$stmt->execute(array($id));
	return $stmt -> fetchAll(PDO::FETCH_ASSOC);
}

function createUser($fullname,$email, $password)
{
	global $db, $BASE_URL;
	$hashPassword = password_hash($password, PASSWORD_DEFAULT);
	$code = generateRandomString(16);
	$stmt = $db ->prepare("INSERT INTO users (fullname,email,password,status,code,mimebia,anhbia,mimeava,avatar,bietdanh,tieusu,quequan,address,workplace,phonenumber,gioitinh,ngaysinh) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	$stmt->execute(array($fullname,$email,$hashPassword,0,$code,'','','','','','','','','','','',''));
	$id =  $db->lastInsertID();
	sendEmail($email, $fullname, 'Kích hoạt tài khoản', "Mã kích hoạt tài khoản của bạn là <a href =\"$BASE_URL/activeUser.php?code=$code\">
		$BASE_URL/activeUser.php?code=$code</a>");
	return $id;
}

function forgotPass($Email)
{
	global $db, $BASE_URL;
	$code = generateRandomString(16);
	$stmt = $db ->prepare("UPDATE users SET code = ? WHERE email = ?");
	$stmt->execute(array($code, $Email));
	sendEmail($Email, 'lấy lại mật khẩu','Mã kích lấy lại mật khẩu của bạn', "mã của bạn là : <h2>$code</h2> <p>hãy dùng mật khẩu này đổi mật khẩu </p>");
}

	
function updatePassword($id, $Password)
{
	global $db;
	$hashPassword = password_hash($Password, PASSWORD_DEFAULT);
	$stmt = $db ->prepare("UPDATE users SET password = ? WHERE id = ?");
	return $stmt->execute(array($hashPassword, $id));
}

function updateUserProfile($id,$fullname,$mimebia,$anhbia,$mimeava,$avatar,$bietdanh,$tieusu,$quequan,$address,$workplace, $phoneNumber,$gioitinh,$ngaysinh)
{
	global $db;
	$stmt = $db ->prepare("UPDATE users SET fullname = ?,mimebia=?,anhbia=?,mimeava=?,avatar=?,bietdanh=?,tieusu=?,quequan=?,address=?,workplace=?,phonenumber = ?,gioitinh = ?,ngaysinh=? WHERE id = ?");
		//var_dump($stmt);
	return $stmt->execute(array($fullname,$mimebia,$anhbia,$mimeava, $avatar,$bietdanh,$tieusu,$quequan,$address,$workplace,$phoneNumber,$gioitinh,$ngaysinh,$id));

}

function resizeImage($filename, $max_width, $max_height)
{
  list($orig_width, $orig_height) = getimagesize($filename);

  $width = $orig_width;
  $height = $orig_height;

  # taller
  if ($height > $max_height) {
      $width = ($max_height / $height) * $width;
      $height = $max_height;
  }

  # wider
  if ($width > $max_width) {
      $height = ($max_width / $width) * $height;
      $width = $max_width;
  }

  $image_p = imagecreatetruecolor($width, $height);

  $image = imagecreatefromjpeg($filename);

  imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);

  return $image_p;
}
function GetTotalPageNewFeeds()
{
	global $db;
	$stmt = $db ->query("SELECT COUNT(*) as total_count FROM posts AS p JOIN users AS u ON p.userID = u.id ORDER BY p.createAt DESC");
	return $stmt -> fetchAll(PDO::FETCH_ASSOC);
}
function getNewFeedsWithPaging($currentUserId, $limit = 5, $page = 1)
{
	global $db;
	$db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
	$stmt = $db ->prepare("select distinct p.*, u.fullname, u.avatar 
	from users as u, posts as p, friendship as fs where (u.id = p.userID and u.id = ?) 
	or (fs.userId1 = ? and u.id = fs.userId2 and p.userID = fs.userId2 and (p.privacy = 0 or p.privacy = 1)) order by p.createAt desc limit ? , ?");
	$calc_page =intVal(($page - 1) * $limit);
	$stmt->execute(array($currentUserId,$currentUserId,$calc_page ,$limit));
	return $stmt -> fetchAll(PDO::FETCH_ASSOC);
}

function GetTotalPageNewFeedsUser($userID)
{
	global $db;
	$stmt = $db ->prepare("SELECT COUNT(*) as total_count FROM posts AS p JOIN users AS u ON p.userID = u.id AND p.userID = ? ORDER BY p.createAt DESC");
	$stmt->execute(array($userID));
	return $stmt -> fetchAll(PDO::FETCH_ASSOC);
}
function findAllFriend($userID)
{
	GLOBAL $db;
	$stmt = $db->prepare("SELECT DISTINCT f1.userId2 FROM friendship AS f1 JOIN friendship AS f2 ON f1.userId2 = f2.userId1 WHERE f1.userId1 =  ?");
	$stmt->execute(array($userID));
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$friends = array();
	foreach($rows AS $row)
	{
		$friends[] = $row['userId2'];
	}
	return $friends;
}
function getNewFeedsWithPagingUser( $userID, $limit = 5, $page = 1)
{
	global $db;
	$db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
	$stmt = $db ->prepare("SELECT p.*, u.fullname,u.avatar FROM posts AS p JOIN users AS u ON p.userID = u.id AND p.userID = ? ORDER BY p.createAt DESC LIMIT ? , ? ");
	$calc_page =intVal(($page - 1) * $limit);
	
	$stmt->execute(array($userID, $calc_page ,$limit));
	
	return $stmt -> fetchAll(PDO::FETCH_ASSOC);
}
function getNewFeedsWithPagingUserFr( $userID, $limit = 5, $page = 1)
{
	global $db;
	$db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
	$stmt = $db ->prepare("SELECT p.*, u.fullname,u.avatar FROM posts AS p JOIN users AS u ON (p.privacy = 0 OR p.privacy =1) AND p.userID = u.id AND p.userID = ? ORDER BY p.createAt DESC LIMIT ? , ? ");
	$calc_page =intVal(($page - 1) * $limit);
	
	$stmt->execute(array($userID, $calc_page ,$limit));
	
	return $stmt -> fetchAll(PDO::FETCH_ASSOC);
}
function getNewFeedsWithPagingUserNotFr( $userID, $limit = 5, $page = 1)
{
	global $db;
	$db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
	$stmt = $db ->prepare("SELECT p.*, u.fullname,u.avatar FROM posts AS p JOIN users AS u ON p.privacy = 0  AND p.userID = u.id AND p.userID = ? ORDER BY p.createAt DESC LIMIT ? , ? ");
	$calc_page =intVal(($page - 1) * $limit);
	
	$stmt->execute(array($userID, $calc_page ,$limit));
	
	return $stmt -> fetchAll(PDO::FETCH_ASSOC);
}

function findRelationship($userId1, $userId2)
{
	GLOBAL $db;
	$stmt = $db->prepare("SELECT * FROM friendship WHERE userId1 = ? AND userId2 = ? OR  userId1 = ? AND userId2=?");
	$stmt->execute(array($userId1, $userId2, $userId2, $userId1));
	$relationship = $stmt->fetchALL(PDO::FETCH_ASSOC);
	return $relationship;
}
function isFriend($userId1, $userId2)
{
    $relationship = findRelationship($userId1, $userId2);
    $isFriend = count($relationship);
    if($isFriend == 2)
	{
		return $isFriend;
	}
	else
	{
		return 1;
	}
}
function getNewFeeds()
{
	global $db;
	$stmt = $db ->query("SELECT p.*, u.fullname,u.avatar FROM posts AS p JOIN users AS u ON p.userID = u.id ORDER BY p.createAt DESC");
	return $stmt -> fetchAll(PDO::FETCH_ASSOC);
}
function getUser()
{
	global $db;
	$stmt = $db ->query("SELECT * from users");
	return $stmt -> fetchAll(PDO::FETCH_ASSOC);
}

function findAllPostOfUser($userID)
{
	global $db;
	$stmt = $db->prepare("SELECT p.*, u.fullname,u.avatar FROM posts AS p, users AS u WHERE p.userID = u.id AND p.userID = ? ORDER BY p.createAt DESC ");
	$stmt->execute(array($userID));
	return $stmt->fetchALL(PDO::FETCH_ASSOC);	 
}

function createPosts($userid, $content, $img, $privacy)
{
	global $db;
	$stmt = $db->prepare("INSERT INTO posts (content,userID,img,privacy) VALUES (?,?,?,?)");
	$stmt->execute(array($content, $userid, $img, $privacy));
	return $db->lastInsertId();
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function sendEmail($to, $name, $subject, $content)
{
	global $EMAIL_FROM, $EMAIL_NAME, $EMAIL_PASSWORD;
	// Instantiation and passing `true` enbles exceptions
	$mail = new PHPMailer(true);
		//Server settings
	
	// Enable verbose debug output
	$mail->isSMTP();
	$mail->CharSet = 'UTF-8';
	// Send using SMTP
	$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                // Enable SMTP authentication
	$mail->Username   = $EMAIL_FROM;                     // SMTP username
	$mail->Password   = $EMAIL_PASSWORD;                               // SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
	// Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
	$mail->Port       = 587;
	// TCP port to connect to

	    //Recipients
	$mail->setFrom($EMAIL_FROM, $EMAIL_NAME);
	$mail->addAddress($to, $name);     // Add a recipient    

	// Content
	$mail->isHTML(true);
	// Set email format to HTML
	$mail->Subject = $subject;
	$mail->Body    = $content;
	//$mail->AltBody = $content;

	$mail->send();    
}
function activeUser($code)
{
	global $db;
	$stmt = $db->prepare("SELECT * FROM users WHERE code = ? and status = ?");
	$stmt->execute(array($code, 0));
	$user = $stmt -> fetchAll(PDO::FETCH_ASSOC);
	if($user && $user[0]['code'] == $code)
	{
		$stmt = $db ->prepare("UPDATE users SET code = ?, status = ? WHERE id = ?");
		$stmt->execute(array('', 1, $user[0]['id']));
		return true;
	}
	return false;
}

function CheckingAuthCodeByEmail($code,$Email)
{
	global $db;
	$stmt = $db->prepare("SELECT * FROM users WHERE code = ? and email = ?");
	$stmt->execute(array($code, $Email));
	$user = $stmt -> fetchAll(PDO::FETCH_ASSOC);
	if($user && $user[0]['code'] == $code)
	{
		return true;
	}
	return false;
}
function loadAvatars($id){
    global $db;
    $stmt =$db->prepare("select * from users where id = ?");
    $stmt->execute(array($id));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function LoadData($id)
{
	global $db;
	$stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
	$stmt->execute(array($id));
	return $stmt -> fetchAll(PDO::FETCH_ASSOC);
}

function sendFriendRequest($userId1, $userId2)
{
	global $db;
	$stmt = $db ->prepare("INSERT INTO friendship(userId1, userId2)VALUES(?, ?)");
	$stmt->execute(array($userId1, $userId2));
}

function getFriendship($userId1, $userId2)
{
	global $db;
	$stmt = $db->prepare("SELECT * FROM friendship WHERE userId1 = ? AND userId2 = ?");
	$stmt->execute(array($userId1, $userId2));
	return $stmt->fetch(PDO::FETCH_ASSOC);
}

function removeFriendRequest($userId1, $userId2)
{
	global $db;
	$stmt = $db ->prepare("DELETE FROM friendship WHERE (userId1 = ? AND userId2 = ?) OR (userId2 = ? AND userId1 = ?)");
	$stmt->execute(array($userId1, $userId2,$userId1, $userId2));
}

function searchFriendByName($name)
{
	global $db;
	$stmt = $db->prepare("SELECT * FROM users where fullname like '%$name%'");
	$stmt->execute(array($name));
	return $stmt -> fetchAll(PDO::FETCH_ASSOC);
}
function getAllCommentOfPost($postid)
{
	GLOBAL $db;
	$stmt = $db->prepare('SELECT * FROM comments WHERE postid= ? ORDER BY createdAt DESC');
	$stmt->execute(array($postid));
	$comments = $stmt->fetchALL(PDO::FETCH_ASSOC);
	return $comments;
}
function getMessagesWithUserId($userId1, $userId2) {
	global $db;
	$stmt = $db->prepare("SELECT * FROM messages WHERE userId1 = ? AND userId2 = ? ORDER BY createdAt");
	$stmt->execute(array($userId1, $userId2));
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
function sendMessage($userId1, $userId2, $content) {
	global $db;
	$stmt = $db->prepare("INSERT INTO messages (userId1, userId2, content, type, createdAt) VALUE (?, ?, ?, ?, CURRENT_TIMESTAMP())");
	$stmt->execute(array($userId1, $userId2, $content, 0));
	$id = $db->lastInsertId();
	$stmt = $db->prepare("SELECT * FROM messages WHERE id = ?");
	$stmt->execute(array($id));
	$newMessage = $stmt->fetch(PDO::FETCH_ASSOC);
	$stmt = $db->prepare("INSERT INTO messages (userId2, userId1, content, type, createdAt) VALUE (?, ?, ?, ?, ?)");
	$stmt->execute(array($userId1, $userId2, $content, 1, $newMessage['createdAt']));
  }
function getLatestConversations($userId) {
	global $db;
	$stmt = $db->prepare("SELECT userId2 AS id, u.fullname, u.avatar FROM messages AS m LEFT JOIN users AS u 
						ON u.id = m.userId2 WHERE userId1 = ? GROUP BY userId2 ORDER BY createdAt DESC");
	$stmt->execute(array($userId));
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	for ($i = 0; $i < count($result); $i++) {
	  $stmt = $db->prepare("SELECT * FROM messages WHERE userId1 = ? AND userId2 = ? ORDER BY createdAt DESC LIMIT 1");
	  $stmt->execute(array($userId, $result[$i]['id']));
	  $lastMessage = $stmt->fetch(PDO::FETCH_ASSOC);
	  $result[$i]['lastMessage'] = $lastMessage;
	}
	return $result;
  }
  function getFriends($userId) {
	global $db;
	$stmt = $db->prepare("SELECT * FROM friendship WHERE userId1 = ? OR userId2 = ?");
	$stmt->execute(array($userId, $userId));
	$followings = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$friends = array();
	for ($i = 0; $i < count($followings); $i++) {
	  $row1 = $followings[$i];
	  if ($userId == $row1['userId1']) {
		$userId2 = $row1['userId2'];
		for ($j = 0; $j < count($followings); $j++) {
		  $row2 = $followings[$j];
		  if ($userId == $row2['userId2'] && $userId2 == $row2['userId1']) {
			$friends[] = findUserById($userId2);
		  }
		}
	  }
	}
	return $friends;
  }


  function createCmt($userid, $content,$postid){

	global $db;
	$stmt = $db->prepare("INSERT INTO comments( content, userid,postid) VALUES (?,?,?)");
	$stmt->execute (array($content, $userid,$postid));
     return $db->lastInsertId();
}
function getCmtByPostID($postid)
{
	global $db;
	$stmt = $db ->prepare("SELECT c.*, u.fullname,u.avatar FROM comments AS c JOIN users AS u ON c.userID = u.id where c.postid = ? ORDER BY c.createAt DESC");
	$stmt->execute([$postid]);
	return $stmt -> fetchAll(PDO::FETCH_ASSOC);
}

function deleteMess($id)
{
	global $db;
	$stmt = $db->prepare("DELETE FROM messages WHERE id = ? ");
	$stmt->execute(array($id));
	return $stmt -> fetchAll(PDO::FETCH_ASSOC);
}
function deleteMessageWithId($id)
  {
    global $db;
    $stmt = $db->prepare("DELETE FROM messages WHERE id=?");
    $stmt->execute(array($id));
  }
function deleteAllMessageWithId($userId1, $userId2)
  {
    global $db;
    $stmt = $db->prepare("DELETE FROM messages WHERE userId1 = ? AND userId2 = ?");
    $stmt->execute(array($userId1, $userId2));
  }

?>