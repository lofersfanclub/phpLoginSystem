<?php

session_start();

$campaign_name = $_POST["campaign_name"];
$campaign_profile_image = $_POST["campaign_profile_image"];
$advertiser_id = $_SESSION["advertiser_id"];

require_once('../../mysqli_connect.php');

$sql = "INSERT INTO campaigns (campaign_name, campaign_profile_image, campaign_created, campaign_updated, advertiser_id) VALUES ('$campaign_name', '$campaign_profile_image', NOW(), NOW(), '$advertiser_id')";

$response = @mysqli_query($dbc, $sql);

if($response){
    
} else {
    echo "Couldn't issue database query";

    echo mysqli_error($dbc);
}

mysqli_close();

header("Location: ../campaigns.php");

?>
