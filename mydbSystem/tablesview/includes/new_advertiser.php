<?php

$advertiser_name = $_POST["advertiser_name"];
$advertiser_profile_image = $_POST["advertiser_profile_image"];

require_once('../../mysqli_connect.php');

$sql = "INSERT INTO advertisers (advertiser_name, advertiser_profile_image, advertiser_created, advertiser_updated) VALUES ('$advertiser_name', '$advertiser_profile_image', NOW(), NOW())";

$response = @mysqli_query($dbc, $sql);

if($response){
    
} else {
    echo "Couldn't issue database query";

    echo mysqli_error($dbc);
}

mysqli_close();

header("Location: ../index.php");

?>
