<?php

$adver_id = $_GET["advertiser_id"];

echo 'Advertiser is: ' . $adver_id;

// populate table
require_once('../../mysqli_connect.php');

$query = "SELECT advertiser_id, advertiser_name, advertiser_profile_image, advertiser_created, advertiser_updated FROM advertisers WHERE advertiser_id=$adver_id ";

$response = @mysqli_query($dbc, $query);

if($response){

    echo '<table align="left" cellspacing="5" cellpadding="8">

    <tr>
    <td align="left"><b>Advertiser Name</b></td>
    <td align="left"><b>Advertiser Image</b></td>
    <td align="left"><b>Advertiser Created</b></td>
    <td align="left"><b>Advertiser Updated</b></td>
    <td align="left"><b>Update Advertiser</b></td>
    <td align="left"><b>Delete Advertiser</b></td>
    <td align="left"><b>Back</b></td>
    </tr>';

    while($row = mysqli_fetch_array($response)){
    echo '<form action="update_advertiser.php" method="POST">
          <input type="hidden" name="advertiser_id" value="'.
            $row['advertiser_id'] .'"/>
        <tr><td align="left">
            <input type="text" name="advertiser_name" value="'.
            $row['advertiser_name'] .'"/>
        </td>
        <td align="left">
            <input type="text" name="advertiser_profile_image" value="'.
            $row['advertiser_profile_image'] .'"/>
        </td>
        <td align="left">' .
            $row['advertiser_created'] . '
        </td>
        <td align="left">' .
            $row['advertiser_updated'] . '
        </td>' .
        '<td align="left">
        <button type="submit">Update Advertiser</button>
        </form>   
        </td>' .

        '<td align="left">
        <form action="delete_advertiser.php" method="POST">
        <input type="hidden" name="advertiser_id" value="'.
        $adver_id .'"/>
        <button type="submit">
        Delete Advertiser
        </button>
        </form>
        </td>';

        '<td align="left">
        <form action="/index.php" method="get">
        <button>
        cancel
        </button>
        </form>
        </td>';

        echo '</tr>';

    }
    echo '</table>';

} else {
    echo "Couldn't issue database query";

    echo mysqli_error($dbc);
}

mysqli_close();



?>
