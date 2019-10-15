<?php

$advertiser_id = $_POST["advertiser_id"];

require_once('../../mysqli_connect.php');

$sql =  "DELETE FROM advertisers WHERE advertiser_id='$advertiser_id'";

$response = @mysqli_query($dbc, $sql);

if($response){
    
} else {
    echo "Couldn't issue database query";

    echo mysqli_error($dbc);
}

mysqli_close();

header("Location: ../index.php");

?>
