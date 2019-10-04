<?php

$campaign_id = $_POST["campaign_id"];

require_once('../../mysqli_connect.php');

$sql =  "DELETE FROM campaigns WHERE campaign_id='$campaign_id'";

$response = @mysqli_query($dbc, $sql);

if($response){
    
} else {
    echo "Couldn't issue database query";

    echo mysqli_error($dbc);
}

mysqli_close();

header("Location: ../advertisers.php");

?>
