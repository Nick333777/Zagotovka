<?php
	include("db.php");
	$check_rating_sql="SELECT `id`,`rating` from `news` ORDER BY `rating` DESC LIMIT 5";
	$check_rating_query=mysqli_query($db, $check_rating_sql);
	while($rate=mysqli_fetch_array($check_rating_query)){
		$rating=$rate['rating'];
		$id=$rate['id'];

		echo "<br>";
		echo "id:";
		echo $id;
		echo "<br>";
		echo "rating:";
		echo $rating;
	}
?>