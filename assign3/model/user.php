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
	private $hasRegistered;

	public function getRollNum() {
		return $this->rollNum;
	}

	public function getRegistrationStatus() {
		return $this->hasRegistered;
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
		$this->hasRegistered = false;

		$password = password_hash( $details["password"], PASSWORD_DEFAULT);
		// TODO confirm password

		$db_delegate = new dbConnection();
		if ( $db_delegate->getError()) {
			$this->errors[] = $db_delegate->getError();
			return '-1';
		}

		$sql_query = "insert into student (rollNum, name, email, password) values
                      ('$this->rollNum', '$this->name', '$this->email', '$password')";

		// TODO Check if rollNum is already present in DB
		$result = $db_delegate->insert_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->errors[] = $db_delegate->getError();
			return '-2';
		}

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

		$this->name = $db_userInfo['name'];
		$this->email = $db_userInfo['email'];
		$this->rollNum = $rollNum;
		$this->hasRegistered = $db_userInfo['registeredCourse'];

		return '0';
	}

	public function courseRegistration($details) {
		$elective = $details['elective'];
		$club = $details['club'];

		$db_delegate = new dbConnection();
		if ( $db_delegate->getError()) {
			$this->errors[] = $db_delegate->getError();
			return '-1';
		}

		$sql_query = "insert into course values
		              ('$this->rollNum', '$elective', '$club')";

		$result = $db_delegate->insert_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->errors[] = $db_delegate->getError();
			return '-2';
		}

		$sql_query = "update student set registeredCourse=1 where rollNum='$this->rollNum'";
		$result = $db_delegate->update_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->errors[] = $db_delegate->getError();
			return '-3';
		}

		$this->hasRegistered = true;
		return '0';
	}

	public function updateRegistration($details) {
		$elective = $details['elective'];
		$club = $details['club'];
		
		$db_delegate = new dbConnection();
		if ( $db_delegate->getError()) {
			$this->errors[] = $db_delegate->getError();
			return '-1';
		}

		$sql_query = "update course set elective='$elective', club='$club' 
		              where rollNum='$this->rollNum'";
		$result = $db_delegate->update_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->errors[] = $db_delegate->getError();
			return '-3';
		}

		return '0';
	}

	public function deleteRegistration() {
		$db_delegate = new dbConnection();
		if ( $db_delegate->getError()) {
			$this->errors[] = $db_delegate->getError();
			return '-1';
		}

		$sql_query = "delete from course where rollNum='$this->rollNum'";
		$result = $db_delegate->update_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->errors[] = $db_delegate->getError();
			return '-4';
		}
	
		$sql_query = "update student set registeredCourse=0 where rollNum='$this->rollNum'";
		$result = $db_delegate->update_query( $sql_query);
		if ( $db_delegate->getError()) {
			$this->errors[] = $db_delegate->getError();
			return '-3';
		}

		$this->hasRegistered = false;
		return '0';
	}

	public function getRegistrationDetails($rollNum) {
		$db_delegate = new dbConnection();
		if ( $db_delegate->getError()) {
			$this->errors[] = $db_delegate->getError();
			return '-1';
		}

		$sql_query = "select * from course where rollNum='$rollNum'";
		$result = $db_delegate->select_query($sql_query);
		if ($db_delegate->getError()) {
			$this->errors[] = $db_delegate->getError();
			return '-2';
		}

		return $result->fetch_assoc();
	}
}

?>
