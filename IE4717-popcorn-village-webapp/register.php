<?php // register.php
	include "dbconnect.php";
	if (isset($_POST['submit'])) {
		if (empty($_POST['username']) || empty ($_POST['password']) 
		|| empty ($_POST['password2']) || empty($_POST['email'])) {
		echo "All records to be filled in";
		exit;}
		}
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];

	// echo ("$username" . "<br />". "$password2" . "<br />");
	if ($password != $password2) {
		echo "Sorry passwords do not match";
		echo '<script>
		alert("Sorry passwords do not match");
		window.location.href="javascript:history.go(-1)";
		</script>';
		exit;
		}
	$password = md5($password);
	//check for existing username
	$query = 'SELECT username from users WHERE username="'.$username.'"';
	$result = $db->query($query);
	if (!$result) {
		echo '<script>
		alert("Sorry username already exists");
		window.location.href="javascript:history.go(-1)";
		</script>';
		exit;
	} else {
		//not exist can insert
		$sql = "INSERT INTO users (username, passwords, email, discount) 
		VALUES ('$username', '$password', '$email', 0.05)";
		$insertresult = $db->query($sql); 
		$db->close();
		if (!$insertresult) {
			echo '<script>
			alert("Sorry request failed");
			window.location.href="javascript:history.go(-1)";
			</script>';
			exit;
		} else {
			echo '<script>
			alert("Registration successful, please login");
			window.location.href="login.php";
			</script>';
			exit;
		}
		
	}
	
?>