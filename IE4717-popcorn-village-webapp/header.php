<?php
session_start();
if (!isset($_SESSION['cart'])) {
	$_SESSION['cart'] = array();
}
?>
<div class="container">
	<nav>
		<a href="index.php">
			<i class="material-icons" style="font-size: 30px; margin-top:10px;">menu</i>
		</a>
		<a href="index.php">
			<i class="material-icons" style="font-size: 30px;">home</i>
			<p>Home</p>
		</a>
		<a href="movies.php">
			<i class="material-icons" style="font-size: 30px;">movie</i>
			<p>Movies</p>
		</a>
		<a href="showtime.php">
			<i class="material-icons" style="font-size: 30px;">view_timeline</i>
			<p>Showtime</p>
		</a>
		<a href="check_bookings.php">
			<i class="material-icons" style="font-size: 30px;">confirmation_number</i>
			<p>Check Bookings</p>
		</a>
		<a href="contact_us.php">
			<i class="material-icons" style="font-size: 30px;">contact_mail</i>
			<p>Contact Us</p>
		</a>
	</nav>

	<div id="rightcol">
		<header>
			<div id="headflex">
				<a style="flex-grow: 10; margin-left: 30px; display: flex; align-items: center;" href="index.php">
					<img style="width: 50px; height: 50px; background-color: none;" src="popcorn.png">
					<h1>Popcorn Village</h1>
				</a>
				<div id="headicons">
					<br>
					<i>Follow us: </i>
					<div class="social-flex">
						<img style="background-color: #ffffff;" src="social_icons/fb.png">
						<img src="social_icons/twitter.png">
						<img src="social_icons/youtube.png">
						<img src="social_icons/ig.png">
					</div>
				</div>
				<div id="headicons">
					<!-- <h4>cart and social</h4> -->
					<a href="cart.php" style="display: inline-block; margin: 20px 0; text-decoration: none;">
						<i class="material-icons" style="font-size: 30px;">shopping_cart</i>
						<span><?php
								$numberitems = 0;
								for ($i = 0; $i < count($_SESSION['cart']); $i++) {
									$seatslist = explode(" ", $_SESSION['cart'][$i]["selected-seats"]);
									$numberitems += count($seatslist);
								}
								echo $numberitems;
								?> items</span>
					</a>
				</div>
				<div id="shortlogin">
					<?php
					if (isset($_SESSION['valid_user'])) {
						echo '<div style="display: flex; align-items: center; justify-content: center;"><i class="material-icons" style="">person</i><h3>' . $_SESSION['valid_user'] . '</h3></div>';
						echo '<a style="
							text-decoration: none;" 
							href="logout.php"><h5><u>Logout</u></h5></a>';
					} else {
						echo '<a style="
							text-decoration: none; display: flex; align-items: center; justify-content: center;" 
							href="login.php"><i class="material-icons" style="">person</i><h4>Login</h4></a>';
					}
					?>
				</div>
			</div>
		</header>

		<!--contents-->