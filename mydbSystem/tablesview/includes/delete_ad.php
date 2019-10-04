<?php

$ad_id = $_POST["ad_id"];

require_once('../../mysqli_connect.php');

$sql =  "DELETE FROM ads WHERE ad_id='$ad_id'";

$response = @mysqli_query($dbc, $sql);

if($response){
    
} else {
    echo "Couldn't issue database query";

    echo mysqli_error($dbc);
}

mysqli_close();

header("Location: ../ads.php");

?>
