<?php

session_start();

$ad_id = $_POST["ad_id"];
$ad_width = $_POST["ad_width"];
$ad_height = $_POST["ad_height"];
$ad_type = $_POST["ad_type"];

require_once('../../mysqli_connect.php');

$sql = "UPDATE ads SET ad_width='$ad_width', ad_height='$ad_height', ad_type='$ad_type', ad_updated=NOW() WHERE ad_id=$ad_id";

$response = @mysqli_query($dbc, $sql);

if($response){
    
} else {
    echo "Couldn't issue database query";

    echo mysqli_error($dbc);
}

mysqli_close();

header("Location: ../ads.php");

?>
