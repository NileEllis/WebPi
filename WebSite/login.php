<?php
/* Check Login form submitted */	
if(isset($_POST['Submit'])){
	/* Check and assign submitted Username and Password to new variable */
	$username = $_POST['username'];
    $password = $_POST['password'];
        
    // Connects to Dabtabase
    $db = new PDO("sqlite:" . "db/WebGUI.db");
    $next = '';    
    $query = "SELECT username FROM users";
    foreach($db->query($query) as $data) {
      if($username == $data["username"]) {
        $next = $next." userfound"; /* Check which is found (Username or Email) */
      }
    }
    if (preg_match("/\buserfound\b/i", $next)) {
      /* Fetch username and associated password from the database */
      $query = "SELECT password FROM users WHERE username = '$username'";
      foreach($db->query($query) as $data) {
        if($password == $data["password"]) {
		  // Success: Set session variables and redirect to Protected page
          if ($checkbox == 'checked') {
            $username_base64 = base64_encode($username);
            setcookie("UserData", $username_base64, time()+78840000, "/","", 0); // If remember me option is selected, it will login the user with the $_COOKIE
          } else { 
            $_SESSION['UserData']['username']=$username; // If remember me option is not selected, it will login the user with the $_SESSION
          }
          // Success: Set session variables and redirect to Protected page
          echo '<meta http-equiv="refresh" content="0; url=index" />'; // Redirects to currect page using meta tag
          exit;
        }
        $msg = '<script>swal("Error", "Invalid Password for Username '.$username.'", "error");</script>';
      }
    }
    if (!isset($msg)) {
      $msg = '<script>swal("Error", "Invalid Username or Email", "error");</script>';
    }
}
include('login-page.php'); // Login Page
exit;
?>