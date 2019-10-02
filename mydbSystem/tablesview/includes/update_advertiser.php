<?php

$advertiser_id = $_POST["advertiser_id"];
$advertiser_name = $_POST["advertiser_name"];
$advertiser_profile_image = $_POST["advertiser_profile_image"];

require_once('../../mysqli_connect.php');

$sql = "UPDATE advertisers SET advertiser_name='$advertiser_name', advertiser_profile_image='$advertiser_profile_image', advertiser_updated=NOW() WHERE advertiser_id=$advertiser_id";

$response = @mysqli_query($dbc, $sql);

if($response){
    
} else {
    echo "Couldn't issue database query";

    echo mysqli_error($dbc);
}

mysqli_close();

header("Location: ../index.php");

?>
