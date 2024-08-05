<!DOCTYPE html>
<html lang="en">

<head>
    <title>Popcorn Village</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/layoutnavheadfoot.css">
    <link rel="stylesheet" href="css/showtime.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Set handler for anchor onclick -->
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function(event) {
            var timeitems = document.getElementsByClassName("button_time");

            for (var i = 0; i < timeitems.length; i++) {
                timeitems[i].onclick = function() {
                    //alert(this.dataset.stid);
                    document.getElementById("stid_selected").value = this.dataset.stid;
                    document.getElementById("st_selection_form").submit();
                    //alert(document.getElementById("stid_selected").value);
                }
            }
        });
    </script>
</head>

<body>
    <?php
    # connect to db
    include "dbconnect.php";
    if (isset($_POST["movieid_selected"])) {
        //mb_substr used to get 1st 3 chars of string
        //for selecting which day
        if (isset($_POST["whichday"])) {
            $tempday = mb_substr($_POST["whichday"], 0, 3);
            $query = 'SELECT showtimes.mid, movies.title, movies.thumbnail, dayofweek, GROUP_CONCAT(stid), GROUP_CONCAT(timeslot) 
            FROM showtimes LEFT JOIN movies on showtimes.mid = movies.mid 
            WHERE dayofweek="' . $tempday . '" and showtimes.mid="' . $_POST["movieid_selected"] .
                '" GROUP BY mid, dayofweek ORDER BY stid';
        } else {
            $query = 'SELECT showtimes.mid, movies.title, movies.thumbnail, dayofweek, GROUP_CONCAT(stid), GROUP_CONCAT(timeslot) 
            FROM showtimes LEFT JOIN movies on showtimes.mid = movies.mid 
            WHERE dayofweek="Mon" and showtimes.mid="' . $_POST["movieid_selected"] .
                '" GROUP BY mid, dayofweek ORDER BY stid';
        }
    } else {
        //for selecting which day
        if (isset($_POST["whichday"])) {
            $tempday = mb_substr($_POST["whichday"], 0, 3);
            //echo $tempday;
            $query = 'SELECT showtimes.mid, movies.title, movies.thumbnail, dayofweek, GROUP_CONCAT(stid), GROUP_CONCAT(timeslot) 
            FROM showtimes LEFT JOIN movies on showtimes.mid = movies.mid 
            WHERE dayofweek="' . $tempday . '" GROUP BY mid, dayofweek ORDER BY stid';
        } else {
            $query = 'SELECT showtimes.mid, movies.title, movies.thumbnail, dayofweek, GROUP_CONCAT(stid), GROUP_CONCAT(timeslot) 
            FROM showtimes LEFT JOIN movies on showtimes.mid = movies.mid 
            WHERE dayofweek="Mon" GROUP BY mid, dayofweek ORDER BY stid';
        }
    }

    $result = $db->query($query);
    $result_num_rows = $result->num_rows;
    $db->close();
    ?>

    <?php include "header.php"; ?>

    <!--contents-->
    <div id="contents">
        <form action="showtime.php" method="post" id="movies_form">
            <?php
            if (isset($_POST["movieid_selected"])) {
                echo '<input type="hidden" id="movieid_selected" name="movieid_selected" value="' . $_POST["movieid_selected"] . '">';
            } else {
            }
            ?>
            <input type="submit" class="button" id="whichday" name="whichday" value="Monday">
            <input type="submit" class="button" id="whichday" name="whichday" value="Tuesday">
            <input type="submit" class="button" id="whichday" name="whichday" value="Wednesday">
            <input type="submit" class="button" id="whichday" name="whichday" value="Thursday">
            <input type="submit" class="button" id="whichday" name="whichday" value="Friday">
            <input type="submit" class="button" id="whichday" name="whichday" value="Saturday">
            <input type="submit" class="button" id="whichday" name="whichday" value="Sunday">
        </form>
        <div class="showtime_container">
            <table border="1" id="showtimetable">
                <!--form to pass timeslot to booking page-->
                <form id="st_selection_form" method="post" action="booking.php">
                    <input type="text" id="stid_selected" name="stid_selected" value="" hidden>
                </form>
                <!--input type="submit" class="button-time" id="coming_soon_btn" name="coming_soon_btn" value="Coming Soon"-->
                <?php
                if ($result_num_rows != 0) {
                    for ($i = 0; $i < $result_num_rows; $i++) {
                        $row = $result->fetch_assoc();
                        echo '
                    <tr>
                    <td style="width: 20%"> <img src="' . $row["thumbnail"] . '"> <p>' . $row["title"] . '</p></td>
                    <td>
                    <div class="col-flex">';
                        $stidarray = explode(",", $row["GROUP_CONCAT(stid)"]);
                        $timearray = explode(",", $row["GROUP_CONCAT(timeslot)"]);
                        //echo sizeof($timearray);
                        for ($j = 0; $j < sizeof($stidarray); $j++) {
                            echo '
                        <a href="#" class="button_time" data-stid="'
                                . $stidarray[$j] .
                                '">'
                                . mb_substr($timearray[$j], 0, -3) .
                                '</a>';
                        }
                        echo '</div></td>
                    </tr>
                    ';
                    }
                }
                ?>
            </table>
        </div>
    </div>

    <?php include "footer.php"; ?>
    <?php $result->free(); ?>
</body>

</html>