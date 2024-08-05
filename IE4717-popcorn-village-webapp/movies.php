<!DOCTYPE html>
<html lang="en">

<head>
    <title>Popcorn Village</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/layoutnavheadfoot.css">
    <link rel="stylesheet" href="css/movies.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Set handler for anchor onclick -->
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function(event) {
            var movieitems = document.getElementsByClassName("movie_select_btn");

            for (var i = 0; i < movieitems.length; i++) {
                movieitems[i].onclick = function() {
                    //alert(this.dataset.movieid);
                    document.getElementById("movieid_selected").value = this.dataset.movieid;
                    document.getElementById("movie_selection_form").submit();
                    //alert(document.getElementById("movieid_selected").value);
                }
            }
        });
    </script>
</head>

<body>
    <?php
    # connect to db
    include "dbconnect.php";

    if (isset($_POST["coming_soon_btn"])) {
        $query = 'SELECT mid, title, thumbnail, release_on FROM movies
                    WHERE release_on>"' . date("Y-m-d") . '";';
    } else {
        $query = 'SELECT mid, title, thumbnail, release_on FROM movies
                    WHERE release_on<="' . date("Y-m-d") . '";';
    }

    $result = $db->query($query);
    $result_num_rows = $result->num_rows;
    $db->close();
    ?>

    <?php include "header.php"; ?>

    <!--contents-->
    <div id="contents">
        <form action="movies.php" method="post" id="movies_form">
            <input type="submit" class="button" id="now_showing_btn" name="now_showing_btn" value="Now Showing">
            <input type="submit" class="button" id="coming_soon_btn" name="coming_soon_btn" value="Coming Soon">
        </form>

        <!-- used for passing the movie id to the movie details page -->
        <form id="movie_selection_form" method="post" action="movie_details.php">
            <input type="text" id="movieid_selected" name="movieid_selected" value="" hidden>
        </form>

        <div class="movie-flex-wrapper">
            <?php
            // movie item loop
            if ($result_num_rows != 0) {
                for ($i = 0; $i < $result_num_rows; $i++) {
                    $row = $result->fetch_assoc();

                    echo '<div class="movie-flex-item">
                            <a href="#" class="movie_select_btn" data-movieid="' . $row["mid"] . '">
                            <img src="' . $row["thumbnail"] . '">
                            <p>' . $row["title"] . '</p>
                            </a>
                         </div>';
                }
            }
            ?>
        </div>
    </div>

    <?php include "footer.php"; ?>
    <?php $result->free(); ?>
</body>

</html>