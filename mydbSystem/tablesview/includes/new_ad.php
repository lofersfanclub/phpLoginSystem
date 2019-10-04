<?php

session_start();

$ad_width = $_POST["ad_width"];
$ad_height = $_POST["ad_height"];
$ad_type = $_POST["ad_type"];
$adset_id = $_SESSION["adset_id"];

require_once('../../mysqli_connect.php');

$sql = "INSERT INTO ads (ad_width, ad_height, ad_type, ad_created, ad_updated, adset_id) VALUES ('$ad_width', '$ad_height', '$ad_type', NOW(), NOW(), '$adset_id')";

$response = @mysqli_query($dbc, $sql);

if($response){
    
} else {
    echo "Couldn't issue database query";

    echo mysqli_error($dbc);
}

mysqli_close();

header("Location: ../ads.php");

?>