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

	public function login() {
	}

	public function signup() {
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

