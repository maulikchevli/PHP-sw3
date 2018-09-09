<?php 

require_once 'dbConnection.php';
/* User class:
 * 
 * methods:
 *
 */

Class User {
	private $errors;

	public function getError() {
		return $this->errors;
	}

	/* register() Returns:
	 * '0' on success
	 * '-1' if connection with DB is not established
	 * '-2' if query fails
	 */
	public function register($details) {
		$name = $details["name"];
		$rollNum = $details["rollNum"];
		$email = $details["email"];

		$password = password_hash( $details["password"], PASSWORD_DEFAULT);
		// TODO confirm password

		$db_delegate = new dbConnection();
		if ( $db_delegate->getError()) {
			$this->errors[] = $db_delegate->getError();
			return '-1';
		}

		$sql_query = "insert into student (rollNum, name, email, password) values
                      ('$rollNum', '$name', '$email', '$password')";

		// TODO Check if rollNum is already present in DB
		$result = $db_delegate->insert_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->errors[] = $db_delegate->getError();
			return '-2';
		}

		// TODO add to session User object
		session_start();
		$_SESSION["rollNum"] = $rollNum;
		
		return '0';
	}

	public function login($details) {
		$rollNum = $details["rollNum"];
		$password = $details["password"];

		$db_delegate = new dbConnection();
		if ( $db_delegate->getError()) {
			$this->errors[] = $db_delegate->getError();
			return '-1';
		}

		$sql_query = "select * from student where rollNum='$rollNum'";
		$result = $db_delegate->select_query($sql_query);
		if ($db_delegate->getError()) {
			$this->errors[] = $db_delegate->getError();
			return '-2';
		}
		elseif ( $result->num_rows != 1) {
			$this->errors[] = "Something buggy in DB";
			return '-3';
		}

		$db_userInfo = $result->fetch_assoc();

		if ( !password_verify( $password, $db_userInfo['password'])) {
			$this->errors[] = "Wrong Password";
			return '-4';
		}

		// TODO add to session User object
		session_start();
		$_SESSION["rollNum"] = $rollNum;
		$_SESSION["hasRegistered"] = $db_userInfo["registeredCourse"];

		return '0';
	}

	public function courseRegistration() {
	}

	public function updateRegistration() {
	}

	public function deleteRegistration() {
	}
}

?>
