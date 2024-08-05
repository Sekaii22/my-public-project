<!DOCTYPE html>
<html lang="en">

<head>
    <title>Popcorn Village</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/layoutnavheadfoot.css">
    <link rel="stylesheet" href="css/movie_details.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
    <?php
    # connect to db
    include "dbconnect.php";

    $query = 'SELECT * FROM movies WHERE mid = ' . $_POST["movieid_selected"] . ';';
    $result = $db->query($query);
    $row = $result->fetch_assoc();
    $db->close();
    ?>

    <?php include "header.php"; ?>

    <!--contents-->
    <div id="contents">
        <div class="detail-wrapper">
            <div class="media-flex-wrapper">
                <?php
                echo '<img src="' . $row["thumbnail"] . '">
                    <iframe src="' . $row["trailer"] . '" title="YouTube video player" frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; 
                    gyroscope; picture-in-picture" allowfullscreen>
                    </iframe>';
                ?>
            </div>

            <div class="details-table">
                <table border="0">
                    <caption>
                        <h2><b>Movie Title</b></h2>
                    </caption>
                    <tr>
                        <th>Synopsis:</th>
                        <td><?php echo $row["sypnosis"]; ?></td>
                        <td style="width:100px; vertical-align: top;">
                            <form action="showtime.php" method="post" id="book-form">
                                <?php
                                    if ($row["release_on"] > date("Y-m-d")) {
                                        //future
                                        echo "<p><i>Coming Soon</i></p>";
                                    } else {
                                        echo '
                                        <input type="text" id="movieid_selected" name="movieid_selected" value="'
                                        .$row["mid"].'" hidden>
                                        <input type="submit" id="book-btn" value="Book">
                                        ';
                                    }
                                ?>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <th style="font-weight: bold;"><u>Details</u></th>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <th>Rating:</th>
                        <td colspan="2"><?php echo $row["rating"]; ?></td>
                    </tr>
                    <tr>
                        <th>Run time:</th>
                        <td colspan="2"><?php echo $row["duration"]; ?></td>
                    </tr>
                    <tr>
                        <th>Cast:</th>
                        <td colspan="2"><?php echo $row["casts"]; ?></td>
                    </tr>
                    <tr>
                        <th>Director:</th>
                        <td colspan="2"><?php echo $row["director"]; ?></td>
                    </tr>
                    <tr>
                        <th>Genre:</th>
                        <td colspan="2"><?php echo $row["genre"]; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>
    <?php $result->free(); ?>
</body>

</html>