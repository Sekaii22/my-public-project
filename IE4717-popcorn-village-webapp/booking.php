<!DOCTYPE html>
<html lang="en">

<head>
    <title>Popcorn Village</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/layoutnavheadfoot.css">
    <link rel="stylesheet" href="css/booking.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
    <?php
    # connect to db
    include "dbconnect.php";
    $seats_row_arr = array("A", "B", "C", "D", "E", "F", "G");
    $seats_col_num = 14;

    if (isset($_POST["stid_selected"])) {
        $query = 'SELECT showtimes.stid, showtimes.mid, showtimes.takenseats, showtimes.timeslot,
                         showtimes.dayofweek, movies.title, movies.thumbnail, movies.price 
                        FROM showtimes INNER JOIN movies ON showtimes.mid = movies.mid 
                        WHERE stid = "' . $_POST["stid_selected"] . '";';

        $result = $db->query($query);
        $result_num_rows = $result->num_rows;
        $row = $result->fetch_assoc();
        $unavailable_seats = explode(" ", trim($row["takenseats"]));
        //print_r($unavailable_seats);
        $result->free();
        $db->close();
    }
    ?>

    <?php
    include "header.php";
    // checks if added to cart button is clicked
    if (isset($_POST["add-btn"])) {
        $_SESSION['cart'][] = array("selected-seats" => trim($_POST["selected-seats"]), "stid_selected" => $_POST["stid_selected"]);

        // redirects
        echo '<script>
                document.addEventListener("DOMContentLoaded", function(event) {
                    if (confirm("Ticket(s) added to cart! Go to cart?")) {
                        window.location.replace("cart.php");
                      } else {
                        window.location.replace("index.php");
                      }
                });
            </script>';
    }
    ?>

    <!--javascript-->
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var seats = document.getElementsByClassName("seat");
            var seat_form_input = document.getElementById("selected-seats");
            var tbody = document.getElementById("summary-table").getElementsByTagName('tbody')[0];
            var totaltd = document.getElementById("total");
            var price = <?php echo $row["price"]; ?>;
            var totalprc = 0;
            var seats_selected;

            // setting handler for seats boxes
            for (var i = 0; i < seats.length; i++) {
                seats[i].onclick = function() {
                    // toggle active class to change css
                    this.classList.toggle('active');

                    // delete old tbody and replace with new empty tbody
                    var new_tbody = document.createElement('tbody');
                    tbody.parentNode.replaceChild(new_tbody, tbody)
                    tbody = document.getElementById("summary-table").getElementsByTagName('tbody')[0];

                    // get all div with active class toggled
                    var toggledseats = document.getElementsByClassName("seat active");

                    // reset variables
                    seats_selected = "";
                    totalprc = 0;

                    // insert row for each active div element found
                    for (var k = 0; k < toggledseats.length; k++) {
                        var row = tbody.insertRow(-1);
                        var seatcell = row.insertCell(0);
                        var qtycell = row.insertCell(1);
                        var pricecell = row.insertCell(2);

                        seatcell.innerHTML = toggledseats[k].dataset.seatnum;
                        qtycell.innerHTML = "1";
                        pricecell.innerHTML = price.toFixed(2);

                        // update variables
                        seats_selected += toggledseats[k].dataset.seatnum + " ";
                        totalprc += price;
                    }

                    // change input in form
                    seat_form_input.value = seats_selected;

                    // change total price html
                    totaltd.innerHTML = totalprc.toFixed(2);
                }
            }
        });
    </script>

    <!--contents-->
    <div id="contents">
        <div id="movie-flex-wrapper">
            <div class="movie-flex-wrapper">
                <?php
                echo '<img src="' . $row["thumbnail"] . '">
                    <div id="movie-text">
                        <h2>' . $row["title"] . '</h2>
                        <p>' . $row["dayofweek"] . ', ' . $row["timeslot"] . '</p>
                    </div>';
                ?>
            </div>

            <div class="cinema-wrapper">
                <h3><u>Select seats:</u></h3>

                <form method="post" action="booking.php" id="update "></form>
                <div class="cinema">
                    <div class="cinema-left">
                        <?php
                        foreach ($seats_row_arr as $row_name) {
                            echo '<div class="row-' . $row_name . '">';
                            for ($i = 1; $i <= $seats_col_num / 2; $i++) {
                                $seatnum = $row_name . $i;

                                if (in_array($seatnum, $unavailable_seats)) {
                                    echo '<div class="seat unavailable" data-seatnum="' . $seatnum . '"></div>';
                                } else {
                                    echo '<div class="seat" data-seatnum="' . $seatnum . '"></div>';
                                }
                            }
                            echo '</div>';
                        }
                        ?>
                    </div>

                    <div class="cinema-right">
                        <?php
                        foreach ($seats_row_arr as $row_name) {
                            echo '<div class="row-' . $row_name . '">';
                            for ($i = ($seats_col_num / 2) + 1; $i <= $seats_col_num; $i++) {
                                $seatnum = $row_name . $i;

                                if (in_array($seatnum, $unavailable_seats)) {
                                    echo '<div class="seat unavailable" data-seatnum="' . $seatnum . '"></div>';
                                } else {
                                    echo '<div class="seat" data-seatnum="' . $seatnum . '"></div>';
                                }
                            }
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>

                <table border="1" id="summary-table">
                    <thead>
                        <tr>
                            <th>Seat</th>
                            <th>Qty</th>
                            <th>Ticket Price ($)</th>
                        </tr>
                    </thead>

                    <tbody>
                    </tbody>

                    <tfoot>
                        <tr>
                            <th colspan="2" style="text-align: right;">Total: $</th>
                            <td id="total">0</td>
                        </tr>
                    </tfoot>
                </table>
                <div style="text-align: right; width: 90%; margin: auto;">
                    <form action="booking.php" method="post">
                        <!-- selected-seats value example "A1 B4 G11 G14 " -->
                        <input type="text" id="selected-seats" name="selected-seats" value="" hidden required>
                        <input type="text" id="stid_selected" name="stid_selected" value="<?php echo $_POST["stid_selected"]; ?>" hidden>
                        <input type="submit" id="add-btn" name="add-btn" value="Add to cart">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end of contents-->

    <?php include "footer.php"; ?>
</body>

</html>