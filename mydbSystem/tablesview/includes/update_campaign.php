<?php

$campaign_id = $_POST["campaign_id"];
$campaign_name = $_POST["campaign_name"];
$campaign_profile_image = $_POST["campaign_profile_image"];

require_once('../../mysqli_connect.php');

$sql = "UPDATE campaigns SET campaign_name='$campaign_name', campaign_profile_image='$campaign_profile_image', campaign_updated=NOW() WHERE campaign_id=$campaign_id";

$response = @mysqli_query($dbc, $sql);

if($response){
    
} else {
    echo "Couldn't issue database query";

    echo mysqli_error($dbc);
}

mysqli_close();

header("Location: ../campaigns.php");

?>
