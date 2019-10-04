<?php

$adset_id = $_POST["adset_id"];
$adset_name = $_POST["adset_name"];

require_once('../../mysqli_connect.php');

$sql = "UPDATE adsets SET adset_name='$adset_name', adset_updated=NOW() WHERE adset_id=$adset_id";

$response = @mysqli_query($dbc, $sql);

if($response){
    
} else {
    echo "Couldn't issue database query";

    echo mysqli_error($dbc);
}

mysqli_close();

header("Location: ../index.php");

?>
