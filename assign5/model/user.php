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

	public function __construct( $username) {
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
	}

	public function signup( $details) {
		/* 
		if ( $details["password"] != $details["password2"]) {
			$this->errors = "Password and confirm password not matching";
			return '-99';
		}

		$password = password_hash( $details["password"], PASSWORD_DEFAULT);
		*/

		$db_delegate = new dbConnection('prototype');
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "insert into user values ('$this->username', '$this->permissionLevel')";

		// username is Unique as it is Primary key
		$result = $db_delegate->insert_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		return true;
	}

	public function logout() {
	}

	public function sendVerification() {
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
		$db_delegate = new dbConnection('prototype');
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
		$db_delegate = new dbConnection('prototype');
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

		$db_delegate = new dbConnection('prototype');
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

		$db_delegate = new dbConnection('prototype');
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

