<?php 

require_once 'dbConnection.php';
/* User class:
 * 
 * methods:
 *
 */

Class User {
	private $errors;
	
	private $name;
	private $rollNum;
	private $email;

	public function getRollNum() {
		return $this->rollNum;
	}

	public function getError() {
		return $this->errors;
	}

	/* register() Returns:
	 * '0' on success
	 * '-1' if connection with DB is not established
	 * '-2' if query fails
	 */
	public function register($details) {
		$this->name = $details["name"];
		$this->rollNum = $details["rollNum"];
		$this->email = $details["email"];

		if ( $details["password"] != $details["password2"]) {
			$this->errors = "Password and confirm password not matching";
			return '-99';
		}

		$password = password_hash( $details["password"], PASSWORD_DEFAULT);

		$db_delegate = new dbConnection();
		if ( $db_delegate->getError()) {
			$this->errors = $db_delegate->getError();
			return '-1';
		}

		$sql_query = "insert into customer (rollNum, name, email, password) values
                      ('$this->rollNum', '$this->name', '$this->email', '$password')";

		// TODO Check if rollNum is already present in DB
		// DONE - implicitly checked by db ( primary key)
		$result = $db_delegate->insert_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->errors = $db_delegate->getError();
			return '-2';
		}

		return '0';
	}

	public function login($details) {
		$rollNum = $details["rollNum"];
		$password = $details["password"];

		$db_delegate = new dbConnection();
		if ( $db_delegate->getError()) {
			$this->errors = $db_delegate->getError();
			return '-1';
		}

		$sql_query = "select * from customer where rollNum='$rollNum'";
		$result = $db_delegate->select_query($sql_query);
		if ($db_delegate->getError()) {
			$this->errors = $db_delegate->getError();
			return '-2';
		}
		elseif ( $result->num_rows != 1) {
			$this->errors = "Wrong password or roll number. Register first before login!";
			return '-3';
		}

		$db_userInfo = $result->fetch_assoc();

		if ( !password_verify( $password, $db_userInfo['password'])) {
			$this->errors = "Wrong Password";
			return '-4';
		}

		$this->name = $db_userInfo['name'];
		$this->email = $db_userInfo['email'];
		$this->rollNum = $rollNum;

		return '0';
	}

}

?>
