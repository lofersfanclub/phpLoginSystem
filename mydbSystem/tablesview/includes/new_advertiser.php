<?php

require_once('../../mysqli_connect.php');

$sql = "INSERT INTO advertisers (advertiser_name, advertiser_profile_image) VALUES ('Youtube', 'http://dummyimage.com/400x400.jpg/dddddd/000000')";

$response = @mysqli_query($dbc, $sql);

if($response){
    
} else {
    echo "Couldn't issue database query";

    echo mysqli_error($dbc);
}

mysqli_close();

header("Location: ../index.php");

?>
