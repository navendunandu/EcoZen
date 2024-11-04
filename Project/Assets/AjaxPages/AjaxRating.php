<?php
session_start();
//submit_rating.php
include("../Connection/Connection.php");

if(isset($_POST['rating_data'])) {
    $rating = $_POST['rating_data'];
    $review = $_POST['user_review'];
    $seller_id = $_POST['pid'];
    $user_id = $_SESSION['uid'];

    // Check if the user has already submitted a review for this product
    $query = "SELECT * FROM tbl_rating WHERE user_id = '$user_id' AND seller_id = '$seller_id'";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0) {
        // Update existing review
        $update_query = "
            UPDATE tbl_rating 
            SET rating_value = '$rating', rating_content = '$review', rating_datetime = NOW() 
            WHERE user_id = '$user_id' AND seller_id = '$seller_id'";
        mysqli_query($con, $update_query);
        echo 'Review Updated Successfully';
    } else {
        // Insert new review
        $insert_query = "
            INSERT INTO tbl_rating (user_id, seller_id, rating_value, rating_content, rating_datetime) 
            VALUES ('$user_id', '$seller_id', '$rating', '$review', NOW())";
        mysqli_query($con, $insert_query);
        echo 'Review Added Successfully';
    }
}

if(isset($_GET["action"]))
{
	$average_rating = 0;
	$total_review = 0;
	$five_star_review = 0;
	$four_star_review = 0;
	$three_star_review = 0;
	$two_star_review = 0;
	$one_star_review = 0;
	$total_user_rating = 0;
	$review_content = array();

	$query = "
	SELECT * FROM tbl_rating r inner join tbl_user c on c.user_id=r.user_id where seller_id = '".$_GET["pid"]."' ORDER BY rating_id DESC
	";

	$result = $con->query($query);

	while($row = $result->fetch_assoc())
	{
		$review_content[] = array(
			'user_id'		=>	$row["user_id"],
			'user_name'		=>	$row["user_name"],
			'user_review'	=>	$row["rating_content"],
			'rating'		=>	$row["rating_value"],
			'datetime'		=>	$row["rating_datetime"]
		);

		if($row["rating_value"] == '5')
		{
			$five_star_review++;
		}

		if($row["rating_value"] == '4')
		{
			$four_star_review++;
		}

		if($row["rating_value"] == '3')
		{
			$three_star_review++;
		}

		if($row["rating_value"] == '2')
		{
			$two_star_review++;
		}

		if($row["rating_value"] == '1')
		{
			$one_star_review++;
		}

		$total_review++;

		$total_user_rating = $total_user_rating + $row["rating_value"];

	}

	$average_rating = $total_user_rating / $total_review;

	$output = array(
		'average_rating'	=>	number_format($average_rating, 1),
		'total_review'		=>	$total_review,
		'five_star_review'	=>	$five_star_review,
		'four_star_review'	=>	$four_star_review,
		'three_star_review'	=>	$three_star_review,
		'two_star_review'	=>	$two_star_review,
		'one_star_review'	=>	$one_star_review,
		'review_data'		=>	$review_content
	);

	echo json_encode($output);

}

?>