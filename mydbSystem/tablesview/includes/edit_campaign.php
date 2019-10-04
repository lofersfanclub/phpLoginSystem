<?php

$campaign_id = $_GET["campaign_id"];

echo 'campaign is: ' . $campaign_id;

// populate table
require_once('../../mysqli_connect.php');

$query = "SELECT campaign_id, campaign_name, campaign_profile_image, campaign_created, campaign_updated FROM campaigns WHERE campaign_id=$campaign_id ";

$response = @mysqli_query($dbc, $query);

if($response){

    echo '<table align="left" cellspacing="5" cellpadding="8">

    <tr>
    <td align="left"><b>campaign Name</b></td>
    <td align="left"><b>campaign Image</b></td>
    <td align="left"><b>campaign Created</b></td>
    <td align="left"><b>campaign Updated</b></td>
    <td align="left"><b>Update campaign</b></td>
    <td align="left"><b>Delete campaign</b></td>
    <td align="left"><b>Back</b></td>
    </tr>';

    while($row = mysqli_fetch_array($response)){
    echo '<form action="update_campaign.php" method="POST">
          <input type="hidden" name="campaign_id" value="'.
            $row['campaign_id'] .'"/>
        <tr><td align="left">
            <input type="text" name="campaign_name" value="'.
            $row['campaign_name'] .'"/>
        </td>
        <td align="left">
            <input type="text" name="campaign_profile_image" value="'.
            $row['campaign_profile_image'] .'"/>
        </td>
        <td align="left">' .
            $row['campaign_created'] . '
        </td>
        <td align="left">' .
            $row['campaign_updated'] . '
        </td>' .
        '<td align="left">
        <button type="submit">Update campaign</button>
        </form>   
        </td>' .

        '<td align="left">
        <form action="delete_campaign.php" method="POST">
        <input type="hidden" name="campaign_id" value="'.
        $campaign_id .'"/>
        <button type="submit">
        Delete campaign
        </button>
        </form>
        </td>
        <td align="left">
        <form action="/index.php">
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
