<!DOCTYPE html>
<html lang="en">

<head>
    <title>Popcorn Village</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/layoutnavheadfoot.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>

<body>
    <?php include "header.php";
    ?>
    <!--contents-->
    <div id="contents">
        <h2>Cart</h2>

        <?php
        if (isset($_GET['empty'])) {
            unset($_SESSION['cart']);
            header('location: ' . $_SERVER['PHP_SELF']);
            exit();
        }
        $total = 0;
        ?>
        <div class="cart_display">
            <!--cart table-->
            <?php include "dbconnect.php"; ?>
            <table border="0">
                <thead>
                    <tr>
                        <th>Movie</th>
                        <th>Seat number</th>
                        <th>Price</th>
                        <th>
                            <a href="<?php echo $_SERVER['PHP_SELF']; ?>?empty=1">
                                <i class="material-icons">delete</i>
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                        $seatslist = explode(" ", $_SESSION['cart'][$i]["selected-seats"]);
                        //2nd loop to go into the specific seats and create 1 row per seat
                        for ($j = 0; $j < count($seatslist); $j++) {
                            //calculation and query for price
                            $stid = $_SESSION['cart'][$i]["stid_selected"];
                            $query = 'SELECT showtimes.mid, movies.title, movies.price 
                                FROM showtimes INNER JOIN movies on showtimes.mid = movies.mid 
                                WHERE stid="' . $stid . '"';
                            $result = $db->query($query);
                            $row = $result->fetch_assoc();
                            $movietitle = $row["title"];
                            $price = $row["price"];
                            $total += $price;
                            echo '<tr>';
                            echo '<td>' . $movietitle . '</td>';
                            echo '<td>' . $seatslist[$j] . '</td>';
                            echo '<td>' . number_format($price, 2) . '</td>';
                            echo '<td style="text-align: center;">
                                <a href="delete_item.php?passing=' . $stid . ',' . $_SESSION['cart'][$i]["selected-seats"] . ',' . $seatslist[$j] . '">
                                <i class="material-icons">delete</i>
                                </a></td>';
                            echo '</tr>';
                        }
                    }

                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" align='right'>Total:</th><br>
                        <th>$<?php echo number_format($total, 2); ?>
                        </th>
                    </tr>
                    <tr>
                        <?php
                        $discount = 0.0;
                        if (isset($_SESSION['valid_user'])) {
                            $query = 'SELECT discount FROM users WHERE username="' . $_SESSION['valid_user'] . '"';
                            $result = $db->query($query);
                            $row = $result->fetch_assoc();
                            $hundred = $row["discount"] * 100;
                            $discount = $total * ($row["discount"]);
                            echo '<th colspan="2" align="right">Discount ' . $hundred . '%:</th><br>';
                            echo '<th>-$' . $discount . '</th>';
                        } else {
                            echo '<th colspan="2" align="right">Discount:</th><br>';
                            echo '<th>NA</th>';
                        }
                        ?>
                        <!--th colspan="2" align='right'>Discount:</th><br>
                    <th align='right'>$<?php echo number_format($total, 2); ?>
                    </th-->
                    </tr>
                    <tr>
                        <?php
                        echo '<th colspan="2" align="right">Total Payable:</th><br>';
                        $payable = $total - $discount;
                        echo '<th>$' . number_format($payable, 2) . '</th>';
                        ?>
                    </tr>
                </tfoot>
            </table>
        </div>



        <div class="payment_details">
            <form id="checkout_form" method="post" action="insert_checkout.php">
                <h4>Payment Details</h4>
                Name:<br />
                <input type="text" id="custname" name="custname" required><br /><br />
                Email:<br />
                <!--input type="text" id="email" name="email"><br /><br /-->
                <?php
                if (isset($_SESSION['valid_user'])) {
                    $query = 'SELECT email FROM users WHERE username="' . $_SESSION['valid_user'] . '"';
                    $result = $db->query($query);
                    $row = $result->fetch_assoc();
                    echo '<input type="text" id="email" name="email" value="' . $row["email"] . '" required><br /><br />';
                } else {
                    echo '<input type="text" id="email" name="email" value="" required><br /><br />';
                }
                ?>
                Card Number:<br />
                <input type="text" id="cardno" name="cardno" required><br /><br />
                <?php
                echo '<input type="text" id="total" name="total" value=' . number_format($payable, 2) . ' required hidden>';
                if (isset($_SESSION['valid_user'])) {
                    echo '<input type="text" id="username" name="username" value="' . $_SESSION['valid_user'] . '" hidden>';
                } else {
                    echo '<input type="text" id="username" name="username" value="" hidden>';
                }
                ?>

                <input type="submit" value="Checkout">

            </form>
            <?php $db->close(); ?>
            <br>
            <br>
        </div>

        <!-- moved to the top right bin in table
            <a href="<?php //echo $_SERVER['PHP_SELF']; 
                        ?>?empty=1">Empty your cart</a></p>
        -->
    </div>
    <!--script for checking email format-->
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function(event) {
            var emailbox = document.getElementById("email");
            emailbox.onchange = chkemail;
            //pwbox2.onchange=chkpwd2;
        });

        function chkemail(event) {
            var myEmail = event.currentTarget;
            var emailRegexp = /^[^@]+@localhost$/;
            //check name
            if (emailRegexp.test(myEmail.value) == true) {

            } else {
                alert("Unacceptable email");
            }
        }
    </script>
    <!--end of contents-->

    <?php include "footer.php"; ?>
</body>

</html>