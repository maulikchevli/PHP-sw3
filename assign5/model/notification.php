<?php

class Notification {
	private $sender;
	private $recipient;
	private $type;
	private $reference;

	public function __construct( $sender, $recipient, $type, $reference) {
		$this->sender = $sender;
		$this->recipient = $recipient;
		$this->type = $type;
		$this->reference = $reference;
	}

	public function store() {
		$db_delegate = new dbConnection('blog');
		if( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		$sql_query = "insert into notifications ( sender, recipient, type, reference) values ( '$this->sender', '$this->recipient', '$this->type', '$this->reference')";
		$result = $db_delegate->insert_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->error = $db_delegate->getError();
			return false;
		}

		return true;
	}
}

?>
