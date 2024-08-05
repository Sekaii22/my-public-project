<?php
    # connect to db
    @$db = new mysqli('localhost', 'root', '', 'popcorn_village');

    # check for db connection error
    if (mysqli_connect_errno()) {
        echo 'Error: Could not connect to database.  Please try again later.';
        exit;
    }
?>