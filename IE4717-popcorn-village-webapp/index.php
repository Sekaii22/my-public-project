<!DOCTYPE html>
<html lang="en">

<head>
    <title>Popcorn Village</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/layoutnavheadfoot.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- JS for carousel -->
    <script>
        var slidePosition = 1;
        var interval;
        var ms = 15 * 1000

        document.addEventListener("DOMContentLoaded", function(event) {
            SlideShow(slidePosition);

            // change slide every 15 sec
            interval = setInterval(MoveForward, ms);

            document.getElementById("forward").onclick = MoveForward;
            document.getElementById("back").onclick = MoveBack;

            // set handler for banner img
            var bannerimgs = document.getElementsByClassName("banner-img");

            for (var i = 0; i < bannerimgs.length; i++) {
                bannerimgs[i].onclick = function() {
                    window.location.href = "movies.php";
                }
            }

        });

        function SlideShow(n) {
            var slides = document.getElementsByClassName("slides-container");

            // wrap around for n more than max length
            if (n > slides.length)
                slidePosition = 1;

            // wrap around for negative n
            if (n < 1)
                slidePosition = slides.length;

            // set all invisible
            for (var i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }

            // enable display for selected slide
            slides[slidePosition - 1].style.display = "block";
        }

        function MoveForward() {
            clearInterval(interval);
            slidePosition += 1;
            SlideShow(slidePosition);
            interval = setInterval(MoveForward, ms);
        }

        function MoveBack() {
            clearInterval(interval);
            slidePosition -= 1;
            SlideShow(slidePosition);
            interval = setInterval(MoveForward, ms);
        }
    </script>

</head>

<body>
    <?php include "header.php"; ?>

    <!--contents-->
    <div id="contents">
        <div class="carousel">
            <!-- can use a loop here to make more entries -->
            <div class="slides-container">
                <img class="banner-img" src="https://img.freepik.com/free-vector/cinema-cartoon-web-banner-young-mesmerized-girl-with-pop-corn-bucket-sitting-movie-theater_107791-6925.jpg?w=1380&t=st=1667111401~exp=1667112001~hmac=80c3b66921d0b049441860ee401278616ac9d0bfb19055f4f8928adda653ee8b">
            </div>

            <div class="slides-container">
                <img class="banner-img" src="https://i0.wp.com/highoncinemaa.com/wp-content/uploads/2022/10/Screenshot-50.png?w=1920&ssl=1">
            </div>

            <div class="slides-container">
                <img class="banner-img" src="https://yc.cldmlk.com/1t5ej9g3h321ae8wvt5fz2gz64/1664798135166_TheaterWebsiteCarousel15.png">
            </div>

            <div class="slides-container">
                <img class="banner-img" src="https://yc.cldmlk.com/1t5ej9g3h321ae8wvt5fz2gz64/1666871572062_TheaterWebsiteCarousel21.png">
            </div>

            <div class="slides-container">
                <img class="banner-img" src="https://yc.cldmlk.com/1t5ej9g3h321ae8wvt5fz2gz64/1666265908997_TheaterWebsiteCarousel19.png">
            </div>

            <a class="back" id="back">&#10094;</a>
            <a class="forward" id="forward">&#10095;</a>
        </div>

        <div class="feature-wrapper">
            <h3 style="margin-left: 10px;"><b>Featured</b></h3>
            <?php
            include "dbconnect.php";
            $featurelist = array('2101', '2202', '2104', '2001');
            if (isset($_SESSION['valid_user'])) {
                $userid = $_SESSION['valid_user'];
                //get featured since login
                //fetch featured for that user
                $fetchq = 'SELECT featured FROM users WHERE username="' . $userid . '";';
                $result = $db->query($fetchq);
                $row = $result->fetch_assoc();
                //customised featured if avail
                if (!empty($row["featured"])) {
                    //convert string to array
                    $featurelist = explode(",", $row["featured"]);
                }
            }
            ?>
            <!-- used for passing the movie id to the movie details page -->
            <form id="movie_selection_form" method="post" action="movie_details.php">
                <input type="text" id="movieid_selected" name="movieid_selected" value="" hidden>
                <div class="feature-flex-container">
                    <!-- query and display featured movies -->
                    <?php
                    for ($i = 0; $i < (sizeof($featurelist)); $i++) {
                        $query = 'SELECT mid, thumbnail, title FROM movies WHERE mid=' . $featurelist[$i] . ';';
                        $result = $db->query($query);
                        $row = $result->fetch_assoc();
                        echo '<div class="feature-flex-item">
                            <a href="#" class="movie_select_btn" data-movieid="' . $row["mid"] . '">
                            <img src="' . $row["thumbnail"] . '">
                            <p>' . $row["title"] . '</p>
                            </a>
                         </div>';
                    }
                    ?>
                </div>
            </form>
        </div>
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
    </div>
    <!--end of contents-->

    <?php include "footer.php"; ?>
</body>

</html>