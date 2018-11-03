<?php

class Blog {
	private $error;
	private $owner;
	private $blogId;

	private $title;
	private $body;

	private $timeOfPost;
	private $likes;
	private $comments;

	public function __construct($owner = "", $title = "", $body = "", $blogId = "") {

		if ( $blogId != "") {
			$this->getDetails( $blogId);
		}
		else {
			$this->owner = $owner;
			$this->title = $title;
			$this->body = $body;
		}
	}

	public function getDetails( $blogId) {
		$this->blogId = $blogId;
		
		$db_delegate = new dbConnection('blog');
		if( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "select * from blog where blogId='$blogId'";
		$result = $db_delegate->select_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$db_blogInfo = $result->fetch_assoc();
		$this->owner = $db_blogInfo["owner"];
		$this->title = $db_blogInfo["title"];
		$this->body = $db_blogInfo["body"];
		$this->timeOfPost = $db_blogInfo["time"];

		$sql_query = "select * from likes where blogId='$blogId'";
		$likeDB = $db_delegate->select_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$this->likes = $likeDB;

		$sql_query = "select * from comments where blogId='$blogId'";
		$commentDB = $db_delegate->select_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$this->comments = $commentDB;

		return true;
	}

	public function isLiker( $username) {
		$db_delegate = new dbConnection('blog');
		if( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "select * from likes where blogId='$this->blogId' and username='$username'";
		$result = $db_delegate->select_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		if ( $result->num_rows < 1) {
			return false;
		}
		else {
			return true;
		}
	}

	public function getError() {
		return $this->error;
	}

	public function getOwner() {
		return $this->owner;
	}

	public function getBlogId() {
		return $this->blogId;
	}

	public function getTitle(){
		return $this->title;
	}

	public function getBody() {
		return $this->body;
	}

	public function getTimeOfPost() {
		return $this->timeOfPost;
	}

	public function getLikeDB() {
		return $this->likes;
	}

	public function getCommentDB() {
		return $this->comments;
	}

	public function setBlogId( $count) {
		// get the count from database
		$this->blogId = $count;
	}
}

?>
