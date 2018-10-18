<?php

/* Users
 * 
 * Three types: Viewer, Blogger, Admin
 */

/* TODO Change constuctor of child, change permission level from there
 */

class User {
	protected $permissionLevel = 0;
	protected $username;
	// Other Info

	public function __construct( $username) {
		$this->username = $username;
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
			$this->errors = $db_delegate->getError();
			return '-1';
		}

		$sql_query = "insert into user values ('$this->username', '$this->permissionLevel')";

		// username is Unique as it is Primary key
		$result = $db_delegate->insert_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->errors = $db_delegate->getError();
			return '-2';
		}

		return '0';
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
	// 1 -> only view rights
	// 2 -> read + write

	public function __construct( $username) {
		parent:: __construct( $username);
		$this->setPermissionLevel( 2);
	}

	public function getProfile() {
	}

	public function getNewNotifs() {
	}

	public function getFollowers() {
	}

	public function getFollowings() {
	}

	public function postBlog() {
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
	}

	public function setPermissions( Blogger $blogger, $permission) {
		if ( $permission != 1 && $permission != 2) {
			return "-1";
		}

		$blogger->setPermissionLevel( $permission);		
	}

	public function deleteBlog() {
	}
}

?>

