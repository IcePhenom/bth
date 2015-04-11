<?php
/**
 * User API.
 */
class CUser {
	/**
	 * Members
	 */
	// private $session_name;
	private $secure;
	private $httponly;
	private $db;

	public function __construct($db){
		$this->db = $db;
		// $this->session_name = 'sec_session'; // Session name.
		$this->secure = false; // Set to true if using https.
		$this->httponly = true; // Disable javascript from accessing session id.
	}

	public function sec_session_start(){
		// ini_set('session.use_only_cookies', 1); // Forces session to only use cookies
		// $cookieParams = session_get_cookie_params(); //Get current cookie params.
		// session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $this->secure, $this->httponly);
		// session_name($this->session_name); // Sets the session name.
		session_start();
	    // session_regenerate_id(true); // regenerated the session, delete the old one.
	}

	public function login($user, $pass){
		$res = $this->db->SingleSelect("SELECT id,user,pass,salt FROM users WHERE user = :user LIMIT 1",array(':user' => $user));

		$password = hash('sha512', $pass.$res['salt']);
		if($this->db->NumRows() == 1) { // If the user exists
			if(self::checkbrute($res['id'])) { // We check if the account is locked, too many login attempts
	            return false; // Account is locked
	        } elseif($res['pass'] == $password) { // Password is correct!

            	$user_id = preg_replace("/[^0-9]+/", "", $res['id']); // XSS protection as we might print this value
            	$_SESSION['user_id'] = $user_id;
            	$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $res['user']); // XSS protection as we might print this value
              	$_SESSION['username'] = $username;
              	$_SESSION['login_string'] = hash('sha512', $res['pass'].$_SERVER['REMOTE_ADDR']);
              	// Login successful.
            	return true;
	        } else {
	        	// Password is not correct, record this attempt in the database
	        	$user_id = preg_replace("/[^0-9]+/", "", $res['id']);
	            $now = time();
	            $this->db->Insert("INSERT INTO login_attempts (user_id, time) VALUES (':id', ':now')",array(':id' => $user_id, ':now' => $now));
	            return false;
	        }
		} else {
			return false; // No user exists.
		}
	}

	private function checkbrute($id){
		// Get timestamp of current time
		$now = time();
		// All login attempts are counted from the past hour.
		$valid_attempts = $now - (60 * 60);

		$this->db->SingleSelect("SELECT time FROM login_attempts WHERE user_id = ':id' AND time > ':now'",array(':id' => $id, ':now' => $valid_attempts));
		// If there has been more than 5 failed logins
		return (($this->db->NumRows() > 5)? true : false);
	}

	public function login_check(){
		// Check if all session variables are set
		if(isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
			$user_id = $_SESSION['user_id'];

			$res = $this->db->SingleSelect("SELECT pass FROM users WHERE id = :id LIMIT 1",array(':id' => $user_id));

			if($this->db->NumRows() == 1){ // If the user exists
				$check = hash('sha512', $res['pass'].$_SERVER['REMOTE_ADDR']);
				if($check == $_SESSION['login_string']){
					// Logged In!!!!
              		return true;
				} else {
					// Not logged in
					return false;
				}
			} else {
				// Not logged in
				return false;
			}
		} else {
			// Not logged in
			return false;
		}
	}

	public function logout(){
		// Unset all session values
		$_SESSION = array();
		// get session parameters
		$params = session_get_cookie_params();
		// Delete the actual cookie.
		setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
		// Destroy session
		session_destroy();
	}
}
