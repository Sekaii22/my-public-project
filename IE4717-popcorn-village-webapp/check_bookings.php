<!DOCTYPE html>
<html lang="en">

<head>
    <title>Popcorn Village</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/layoutnavheadfoot.css">
    <link rel="stylesheet" href="css/check_bookings.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <?php
    // for retaining value of email input after refreshing
    if (isset($_POST["check-btn"])) {
        echo '<script type="text/javascript">
                document.addEventListener("DOMContentLoaded", function(event) {
                document.getElementById("email-input").value = "' . $_POST["email-input"] . '";
                });
            </script>';
    }
    ?>
</head>

<body>
    <?php
    # connect to db
    include "dbconnect.php";

    if (isset($_POST["check-btn"])) {
        $query = 'SELECT customers.custname, movies.title, purchases.seat, 
                    purchases.tid, purchases.moviedate, purchases.movietime 
                    FROM ((purchases INNER JOIN customers ON purchases.rid = customers.rid) 
                    INNER JOIN movies ON purchases.mid = movies.mid) 
                    WHERE customers.email = "' . $_POST["email-input"] . '";';

        $result = $db->query($query);
        $result_num_rows = $result->num_rows;
        $db->close();
    }
    ?>

    <?php include "header.php"; ?>

    <!--contents-->
    <div id="contents">
        <h2><b>Check Bookings</b></h2>
        <form method="post" action="check_bookings.php" id="check-form">
            <label for="email-input">Email: </label>
            <input type="text" id="email-input" name="email-input" placeholder="abc@xyc.com" required>
            <input type="submit" id="check-btn" name="check-btn" value="Check">
        </form>

        <?php
        if (isset($_POST["check-btn"])) { ?>

            <table border="1">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Movie Title</th>
                        <th>Seat No</th>
                        <th>Ticket No</th>
                        <th>Date and Time</th>
                    </tr>
                </thead>

                <tbody>
                    <!-- loop here -->
                    <?php
                    for ($i = 0; $i < $result_num_rows; $i++) {
                        $row = $result->fetch_assoc();

                        echo '<tr>
                                <td>' . $row["custname"] . '</td>
                                <td>' . $row["title"] . '</td>
                                <td>' . $row["seat"] . '</td>
                                <td>' . $row["tid"] . '</td>
                                <td>' . $row["moviedate"] . ', ' . $row["movietime"] . '</td>
                            </tr>';
                    }
                    ?>
                </tbody>
            </table>

        <?php
            $result->free();
        }
        ?>
    </div>

    <?php include "footer.php"; ?>
</body>

</html>