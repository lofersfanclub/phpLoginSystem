<?php

$adset_id = $_POST["adset_id"];

require_once('../../mysqli_connect.php');

$sql =  "DELETE FROM adsets WHERE adset_id='$adset_id'";

$response = @mysqli_query($dbc, $sql);

if($response){
    
} else {
    echo "Couldn't issue database query";

    echo mysqli_error($dbc);
}

mysqli_close();

header("Location: ../adsets.php");

?>
