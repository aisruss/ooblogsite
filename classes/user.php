<?php

include('passwordchecks.php');

class User extends PasswordChecks{

    private $db;
	public $userId;
	public $username;
	public $email;

	public function __construct($db){
		parent::__construct();

		$this->userId;
		$this->username;
		$this->email;

		$this->_db = $db;
	}


	public function is_logged_in(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}
	}

	public function getUserDetails($username){
		try {

			$stmt = $this->_db->prepare('SELECT * FROM users WHERE username = :username');
			$stmt->execute(array('username' => $username));

			$results = $stmt->fetch();

			return $results;

		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function getUserById($userId) {
		try {

			$stmt = $this->_db->prepare('SELECT user_id, username, password FROM users WHERE user_id = :userId');
			$stmt->execute(array('userId' => $userId));

			$results = $stmt->fetch();
			$this->username = $results['username'];

			return $results;
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function login($username,$password){
		$user = $this->getUserDetails($username);
		if($this->password_verify($password,$user['password']) == 1){
			$_SESSION['loggedin'] = true;
			$_SESSION['userId'] = $user['user_id'];
			return true;
		}
	}

	public function logout(){
		session_destroy();
	}

	public function getUserId() {
		return $this->userId;
	}

	public function getUsername() {
		return $this->username;
	}

	public function setUsername($username) {
		$this->username = $username;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function checkUserRecordExists($username, $email) {
		try {

			$stmt = $this->_db->prepare('SELECT username FROM users WHERE username = :username OR email =  :email');
			$stmt->execute(array(':username' => $username,
				                 ':email' => $email
			));
			$stmt->fetch();

			if ($stmt->rowCount() > 0) {
				return true;
			} else {
				return false;
			}

		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function createUser($formData) {
            //password hash
            $password = password_hash($formData['password'], PASSWORD_DEFAULT);
            //insert into database
            $stmt = $this->_db->prepare('INSERT INTO users (username,password,email) VALUES (:username, :password, :email)') ;
            $stmt->execute(array(
                ':username' => $formData['username'],
                ':password' => $password,
                ':email' => $formData['email']

            ));

		//header('Location: index.php');
	}
}


?>
