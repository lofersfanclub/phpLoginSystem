<?php

require_once('../mysqli_connect.php');

$query = "SELECT advertiser_id, advertiser_name, advertiser_profile_image, advertiser_created, advertiser_updated FROM advertisers";

$response = @mysqli_query($dbc, $query);

if($response){

    echo '<table align="left" cellspacing="5" cellpadding="8">

    <tr>
    <td align="left"><b>Advertiser ID</b></td>
    <td align="left"><b>Advertiser Name</b></td>
    <td align="left"><b>Advertiser Image</b></td>
    <td align="left"><b>Advertiser Created</b></td>
    <td align="left"><b>Advertiser Updated</b></td>
    <td align="left"><b>Advertiser Campaigns</b></td>
    </tr>';

    while($row = mysqli_fetch_array($response)){
        echo '<tr><td align="left">' . 
        $row['advertiser_id'] . '</td><td align="left">' . 
        $row['advertiser_name'] . '</td><td align="left">' . 
        $row['advertiser_profile_image'] . '</td><td align="left">' . 
        $row['advertiser_created'] . '</td><td align="left">' . 
        $row['advertiser_updated'] . '</td><td align="left">' . 
        'campaigns/' . $row['advertiser_id'] . '</td>';
        
        echo '</tr>';

    }

    echo '</table>';
} else {
    echo "Couldn't issue database query";

    echo mysqli_error($dbc);
}

mysqli_close();

?>