<!DOCTYPE html>
<html lang="en">

<head>
    <title>Popcorn Village</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/layoutnavheadfoot.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>

<body>
    <?php include "header.php"; ?>

    <!--contents-->
        <?php
          // store to test if they *were* logged in
          $old_user = $_SESSION['valid_user'];  
          unset($_SESSION['valid_user']);
          if (!isset($_SESSION['cart'])) {
            //if no cart
            session_destroy();
          }
        ?>
        <html>
        <body>
        <h1>Logged out</h1>
        <?php 
          if (!empty($old_user))
          {
            echo 'Logged out.<br />';
            echo '<script>
            alert("Logged out");
            window.location.href="index.php";
            </script>';
            exit;  
          }
          else
          {
            // if they weren't logged in but came to this page somehow
            echo 'You were not logged in, and so have not been logged out.<br />'; 
          }
        ?>
    <?php include "footer.php"; ?>
</body>

</html>
