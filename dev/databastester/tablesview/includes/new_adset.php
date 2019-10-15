<?php

session_start();

$adset_name = $_POST["adset_name"];
$campaign_id = $_SESSION["campaign_id"];

require_once('../../mysqli_connect.php');

$sql = "INSERT INTO adsets (adset_name, adset_created, adset_updated, campaign_id) VALUES ('$adset_name', NOW(), NOW(), '$campaign_id')";

$response = @mysqli_query($dbc, $sql);

if($response){
    
} else {
    echo "Couldn't issue database query";

    echo mysqli_error($dbc);
}

mysqli_close();

header("Location: ../adsets.php");

?>