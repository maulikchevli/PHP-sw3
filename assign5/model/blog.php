<?php

class Blog {
	private $owner;
	private $blogId;

	private $title;
	private $body;

	private $timeOfPost;
	private $likes;
	private $comments;

	public function __construct( $owner, $title, $body) {
		$this->owner = $owner;
		$this->title = $title;
		$this->body = $body;
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

	public function setBlogId( $count) {
		// get the count from database
		$this->blogId = $count;
	}
}

?>
