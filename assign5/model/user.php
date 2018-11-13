<?php

/* Users
 * 
 * Three types: Viewer, Blogger, Admin
 */

/*
 * TODO update constructor to get details of user if logged in
 */

class User {
	protected $error;
	protected $permissionLevel = 0;
	protected $username;
	protected $emailVerified = false;

	protected $lastLogin;
	// Other Info

	public function __construct( $username = "") {
		$this->username = $username;
	}

	public function getError() {
		return $this->error; 
	}

	public function getUsername() {
		return $this->username;
	}

	public function getPermissionLevel() {
		return $this->permissionLevel;
	}

	public function getLastLogin() {
		return $this->lastLogin;
	}

	public function isEmailVerified() {
		return $this->emailVerified;
	}

	protected function setPermissionLevel( $permission) {
		$this->permissionLevel = $permission;
	}

	public function setLastLogin( $time) {
	}

	public function getDetails() {
		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "select username,firstName,lastName,email,birthDate,bio,emailVerified,userType,lastLogin from user where username='$this->username'";
		$result = $db_delegate->select_query($sql_query);
		if ($db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$db_userInfo = $result->fetch_assoc();
		$this->emailVerified = $db_userInfo["emailVerified"];
		$this->permissionLevel = $db_userInfo["userType"];
		$this->lastLogin = $db_userInfo["lastLogin"];

		return $db_userInfo;
	}

	// $details contants all the info of user to insert in  DB
	// it will not contain permissionLevel
	public function login( $details) {
		$password = $details["password"];

		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "select * from user where username='$this->username'";
		$result = $db_delegate->select_query($sql_query);
		if ($db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}
		elseif ( $result->num_rows != 1) {
			$this->error = "Wrong password or roll number. Register first before login!";
			return false;
		}

		$db_userInfo = $result->fetch_assoc();

		if ( !password_verify( $password, $db_userInfo['password'])) {
			$this->error = "Wrong Password";
			return false;
		}

		$this->permissionLevel = $db_userInfo["userType"];
		$this->emailVerified = $db_userInfo["emailVerified"];
		$this->lastLogin = $db_userInfo["lastLogin"];

		return true;
	}

	public function signup( $details) {
		if ( $details["password"] != $details["password2"]) {
			$this->error = "Password and confirm password not matching";
			return false;
		}
		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$password = password_hash( $details["password"], PASSWORD_DEFAULT);
		$firstName = $details["firstName"];
		$lastName = $details["lastName"];
		$email = $details["email"];
		$birthDate = $details["birthDate"];
		if ( $details["bio"]) {
			$bio = $details["bio"];
		}
		else {
			$bio = NULL;
		}

		$sql_query = "insert into user (username, userType, firstName, lastName, email, password, birthDate, bio) 
		              values ('$this->username', '$this->permissionLevel', '$firstName', '$lastName', '$email', '$password', '$birthDate', '$bio')"; 

		// username is Unique as it is Primary key
		$result = $db_delegate->insert_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		if ( $this->sendEmailVerification( $email))
			return true;
		else {
			// TODO delete entry from table
			$this->error = "Could not send mail, try again";
			return false;
		}
	}

	public function updateEmailVerification() {
		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "update user set emailVerified=1 where username='$this->username'";
		$result = $db_delegate->update_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$this->emailVerified = true;

		return true;
	}

	public function sendEmailVerification( $email) {
		$encrypted_string=openssl_encrypt($this->username,"AES-128-ECB","password");

		$verifyLink = 'localhost:8888/sw_tools/sw3/assign5/action/verifyUserEmail.php?username='.urlencode($this->username).'&pass='.urlencode($encrypted_string);

		$subject = 'Verify your account';
		$body = '
		Welcome to our Blog.

		To verify your account click the link below:
		' . $verifyLink;

		if ( $this->sendMail( $email, $subject, $body)) {
			return true;
		}
		else return false;
	}

	public function sendMail( $email, $subject, $body) {
		require_once 'PHPMailer/PHPMailer.php';
		require_once 'PHPMailer/SMTP.php';
		//Create a new PHPMailer instance
		$mail = new PHPMailer;
		//Tell PHPMailer to use SMTP
		$mail->isSMTP();

		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 2;
		//Set the hostname of the mail server

		$mail->Host = 'smtp.gmail.com';
		// use
		// $mail->Host = gethostbyname('smtp.gmail.com');
		// if your network does not support SMTP over IPv6
		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 465;
		$mail->SMTPSecure = 'ssl';
		$mail->SMTPAuth = true;

		$mail->Username = "maulikchevliwork@gmail.com";
		$mail->Password = "Maulik123";

		$mail->setFrom('maulikchevliwork@gmail.com', 'Maulik Chevli');
		$mail->addReplyTo('replyto@example.com', 'First Last');

		$mail->addAddress($email);

		$mail->Subject = $subject;
		$mail->Body = $body;

		if (!$mail->send()) {
			return false;
		} else {
			return true;
		}
	}

	public function getBlogs() {
		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "select * from blog ORDER BY time DESC LIMIT 10";
		$result = $db_delegate->select_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		return $result;
	}

	public function getBlogsDetails( $owner) {
		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "select * from blog where owner='$owner' ORDER BY time DESC LIMIT 10";
		$result = $db_delegate->select_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		return $result;
	}

	public function getLikes( $blogId) {
		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "select * from likes where blogId='$blogId'";
		$result = $db_delegate->select_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		return $result;
	}

	public function getComments( $blogId) {
		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "select * from comments where blogId='$blogId'";
		$result = $db_delegate->select_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		return $result;
	}

	public function __destruct() {
	}	
}

class Blogger extends User {
	// Permission level should be 1 or 2
	// 0 -> only view rights
	// 1 -> read + write
	// 2 -> verified by admin

	public function __construct( $username, $permissionLevel = 1) {
		parent:: __construct( $username);
		$this->setPermissionLevel( $permissionLevel);
	}

	public function getNewNotifs() {
		// Implement after blog and user, html
	}

	public function getFollowers() {
		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "select follower from followers where username='$this->username'";
		$result = $db_delegate->select_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		return $result;
	}

	public function getFollowings() {
		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "select username from followers where follower='$this->username'";
		$result = $db_delegate->select_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		return $result;
	}

	public function follow( $username) {
		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "insert into followers values ( '$username', '$this->username')";
		$result = $db_delegate->insert_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		// TODO notifications of follow

		return true;
	}
		

	public function unfollow( $username) {
		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "delete from followers where follower='$this->username' and username='$username'";
		$result = $db_delegate->update_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		return true;
	}

	public function sendVerifyRequest() {
		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "insert into verifyRequest values ('$this->username')";

		$result = $db_delegate->insert_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}
		
		return true;
	}

	public function postBlog( Blog $blog) {
		// other details about blog

		$title = $blog->getTitle();
		$owner = $blog->getOwner();
		$body = $blog->getBody();

		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "insert into blog (owner, title, body) values ('$owner', '$title', '$body')";

		$result = $db_delegate->insert_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}
		
		return true;
	}

	public function getBlogs() {
		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "select * from blog where owner='$this->username' LIMIT 10";
		$result = $db_delegate->select_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		return $result;
	}

	public function updateBlog() {
		// Last
	}

	public function deleteBlog($blogId, $username) {
		/* Username is added  only for polymorphism */

		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "delete from blog where blogId='$blogId'";
		$result = $db_delegate->update_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		return true;
	}

	public function likeBlog( $blogId) {
		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "insert into likes values ( '$blogId', '$this->username')";

		$result = $db_delegate->insert_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}
		
		return true;
	}

	public function unlikeBlog( $blogId) {
		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "delete from likes where blogId='$blogId' and username='$this->username'";

		$result = $db_delegate->update_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}
		
		return true;
	}

	public function commentOnBlog( $blogId, $comment) {
		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "insert into comments values ( '$blogId', '$this->username', '$comment')";

		$result = $db_delegate->insert_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}
		
		return true;
	}

	public function getNotifications() {
		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "select * from notifications where recipient='$this->username' and unread=true";
		$result = $db_delegate->select_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		// Update table to reset unread column
		$sql_query = "update notifications set unread=false where unread=true and recipient='$this->username'";
		// No error control here
		$db_delegate->update_query( $sql_query);
		
		return $result;
	}

	public function notificationLog() {
		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "select * from notifications where recipient='$this->username' order by time desc";
		$result = $db_delegate->select_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}
		
		return $result;
	}

	public function getNumNotifs() {
		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "select count(*) as count from notifications where recipient='$this->username' and unread=true";
		$result = $db_delegate->select_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}
		
		$count = $result->fetch_assoc();
		$count = $count["count"];
		return $count;
	}
}

class Admin extends Blogger {
	// permission Level 3

	public function __construct( $username, $permissionLevel = 3) {
		parent:: __construct( $username);
		$this->setPermissionLevel( $permissionLevel);
	}

	public function getAllUsers() {
		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			// TODO make set erorr function
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "select * from user";
		$result = $db_delegate->select_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		return $result;
	}

	public function verifyUser( $username) {
		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "update user set userType=2 where username='$username'";
		$result = $db_delegate->update_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "delete from verifyRequest where username='$username'";
		$result = $db_delegate->update_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		return true;
	}

	public function getVerifyRequests() {
		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "select v.username, u.userType from verifyRequest v, user u where u.username=v.username";
		$result = $db_delegate->select_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		return $result;
	}

	public function setPermissions( $username, $permission) {
		if ( $permission != 0 && $permission != 1 && $permission != 2) {
			return false;
		}

		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "update user set userType='$permission' where username='$username'";
		$result = $db_delegate->update_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		return true;
	}

	public function deleteBlog($blogId, $username) {
		// TODO add notification to user whose blog is deleted
		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "delete from blog where blogId='$blogId'";
		$result = $db_delegate->update_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		return true;
	}
}

function searchQuery( $searchQuery) {
	$db_delegate = new dbConnection('blog');
	if ( $db_delegate->getError()) {
		$this->error = $db_delegate->getError();
		return false;
	}

	$searchQuery .= "%";

	$sql_query = "select username,firstName,lastName from user where username LIKE '$searchQuery'
	              or firstName LIKE '$searchQuery' or lastName LIKE '$searchQuery'";
	$users = $db_delegate->select_query( $sql_query);
	if ( $db_delegate->getError()) {
		$this->error = $db_delegate->getError();
		return false;
	}
	$result["username"] = $users;

	$searchQuery = "%" . $searchQuery;
	$sql_query = "select blogId,title from blog where title LIKE '$searchQuery'";
	$blogs = $db_delegate->select_query( $sql_query);
	if ( $db_delegate->getError()) {
		$this->error = $db_delegate->getError();
		return false;
	}
	$result["blog"] = $blogs;

	return $result;
}

?>

