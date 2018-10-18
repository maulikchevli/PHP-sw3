<?php 
class dbConnection {
	private $query_statement;
	private $conn;
	private $error;

	public function __construct() {
		$this->conn = new mysqli('localhost','root','root','blog');
		if ($this->conn->connect_error) {
			$this->error = 'Could not connect to database';
			return; // -1 for connection failed
		}
	}
	
	public function select_query($sql) {
		$result = $this->conn->query($sql);
		if ($result === FALSE) {
			$this->error = 'Could not perform select query';
			return;// -2 for Failed query
		} 
		else {
			return $result; // then run $rows = $result->fetch_assoc()  
		}
	}

	public function getError() {
		return $this->error;
	}

	public function insert_query($sql) {
		if ($this->conn->query($sql) === FALSE) {
			$this->error = 'Could not perform insert query';
			return; // -2 for Failed query
		}
	}

	public function update_query($sql) {
		if ($this->conn->query($sql) === FALSE) {
			$this->error = 'Could not perform update query';
			return; // -2 for Failed query
		}
	}

	public function __destruct() {
		$this->conn->close();
	}
}

?>
