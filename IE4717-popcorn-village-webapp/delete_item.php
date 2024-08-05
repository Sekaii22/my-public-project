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
        <?php
        if (isset($_GET['passing'])) {
            $passing = $_GET['passing'];
        }
        $infoarr = explode(",", $passing);
        /*echo $infoarr[0];
            echo $infoarr[1];
            echo $infoarr[2];*/
        $arr = $_SESSION['cart'];
        $i = array_search(array("selected-seats" => $infoarr[1], "stid_selected" => $infoarr[0]), $arr);
        $temp_arr = explode(" ", $arr[$i]["selected-seats"]);
        $j_to_del = array_search($infoarr[2], $temp_arr);
        array_splice($temp_arr, $j_to_del, 1);
        if (empty($temp_arr)) {
            array_splice($arr, $i, 1);
            $_SESSION['cart'] = $arr;
        } else {
            $_SESSION['cart'][$i]["selected-seats"] = implode(" ", $temp_arr);
        }
        header('location: cart.php');
        ?>
    </div>
    <!--end of contents-->

    <?php include "footer.php"; ?>
</body>

</html>