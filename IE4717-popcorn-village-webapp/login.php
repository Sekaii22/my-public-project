<!DOCTYPE html>
<html lang="en">

<head>
    <title>Popcorn Village</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/layoutnavheadfoot.css">
    <link rel="stylesheet" href="css/loginoutregis.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>

<body>
    <?php include "header.php";
    ?>
    <!--contents-->
    <div id="contents">
        <?php
        if (isset($_POST['userid']) && isset($_POST['password'])) {
            // if the user has just tried to log in
            include "dbconnect.php";
            $userid = $_POST['userid'];
            $password = $_POST['password'];
            $password = md5($password);
            $query = 'select username, passwords from users '
                . "where username='$userid' "
                . " and passwords='$password'";
            // echo "<br>" .$query. "<br>";
            $result = $db->query($query);
            if ($result->num_rows > 0) {
                // if they are in the database register the user id
                $_SESSION['valid_user'] = $userid;
                echo '<script>
			alert("Logged in as: ' . $_SESSION['valid_user'] . '");
			window.location.href="index.php";
			</script>';
                exit;
            } else {
                echo '<script>
			alert("Invalid username or password");
			window.location.href="javascript:history.go(-1)";
			</script>';
                exit;
            }
            $db->close();
        }
        //form for login
        echo '<h2><b>Login</b></h2>';
        echo '<div class="login-wrapper">';
        echo '<form method="post" action="login.php">';
        echo '<table>';
        echo '<tr><th>Userid:</th>';
        echo '<td><input type="text" name="userid"></td></tr>';
        echo '<tr><th>Password:</th>';
        echo '<td><input type="password" name="password"></td></tr>';
        echo '<tr><td colspan="2" align="right">';
        echo '<input type="submit" value="Log in"></td></tr>';
        echo '</table></form></div>';
        echo '
        <p>New user? 
        <u><a href="registration.php">Register here</a></u>
        </p>'
        ?>
    </div>
    <!--end of contents-->

    <?php include "footer.php"; ?>
</body>

</html>