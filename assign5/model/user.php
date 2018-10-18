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
	private $permissionLevel = 2;

	public function getPermissionLevel() {
		return $this->permissionLevel;
	}

	protected function setPermissionLevel( $permission) {
		echo "HEY <br>";
		$this->permissionLevel = $permission;
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
	private $permissionLevel = 3;

	public function getPermissionLevel() {
		return $this->permissionLevel;
	}

	public function verifyBlogger( Blogger $blogger) {
	}

	public function setPermissions( Blogger $blogger, $permission) {
		var_dump( $blogger);
		echo "<br>";

		if ( $permission != 1 && $permission != 2) {
			return "-1";
		}

		$blogger->setPermissionLevel( $permission);		
	}

	public function deleteBlog() {
	}
}

?>

