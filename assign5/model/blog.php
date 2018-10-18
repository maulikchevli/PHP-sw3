<?php

class Blog {
	private $owner;
	private $blogId;

	private $title;

	private $timeOfPost;
	private $likes;
	private $comments;

	public function __construct( $owner, $title) {
		$this->owner = $owner;
		$this->title = $title;
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

	public function setBlogId( $count) {
		// get the count from database
		$this->blogId = $count;
	}
}

?>
