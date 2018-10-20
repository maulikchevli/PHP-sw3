<?php

/* Users
 * 
 * Three types: Viewer, Blogger, Admin
 */

/*
 * TODO Get blog Counter from dataBase on user login
 */

class User {
	protected $error;
	protected $permissionLevel = 0;
	protected $username;
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

	protected function setPermissionLevel( $permission) {
		$this->permissionLevel = $permission;
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

		return true;
	}

	public function signup( $details) {
		if ( $details["password"] != $details["password2"]) {
			$this->error = "Password and confirm password not matching";
			return false;
		}
Username();
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

	public function __destruct() {
	}	
}

class Blogger extends User {
	// Permission level should be 1 or 2
	// 0 -> only view rights
	// 1 -> read + write
	// 2 -> verified by admin

	public function __construct( $username) {
		parent:: __construct( $username);
		$this->setPermissionLevel( 1);
	}

	public function getProfile() {
		// After html form
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

	public function postBlog( Blog $blog) {
		// other details about blog

		$title = $blog->getTitle();
		$username = $blog->getOwner();

		$db_delegate = new dbConnection('blog');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "insert into blog (username, title) values ('$username', '$title')";

		$result = $db_delegate->insert_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}
		
		var_dump( $result);

		return true;
	}

	public function updateBlog() {
	}

	public function likeBlog() {
	}

	public function commentOnBlog() {
	}
}

class Admin extends User {
	// permission Level 3

	public function __construct( $username) {
		parent:: __construct( $username);
		$this->setPermissionLevel( 3);
	}

	public function verifyBlogger( Blogger $blogger) {
		// After html form
	}

	public function setPermissions( Blogger $blogger, $permission) {
		if ( $permission != 1 && $permission != 2) {
			return "-1";
		}

		$blogger->setPermissionLevel( $permission);		
	}

	public function deleteBlog( Blog $blog) {
		$blogId = $blog->getBlogId();

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

?>

