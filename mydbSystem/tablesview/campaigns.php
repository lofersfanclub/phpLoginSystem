
Welcome <?php echo $_GET["advertiser_id"]; ?><br>

<?php

$adver_id = $_GET["advertiser_id"];

require_once('../mysqli_connect.php');

$query = "SELECT campaign_id, campaign_name, campaign_profile_image, campaign_created, campaign_updated, advertiser_id FROM campaigns WHERE advertiser_id=$adver_id";

$response = @mysqli_query($dbc, $query);

if($response){

    echo '<table align="left" cellspacing="5" cellpadding="8">

    <tr>
    <td align="left"><b>Advertiser ID</b></td>
    <td align="left"><b>Campaign ID</b></td>
    <td align="left"><b>Campaign Name</b></td>
    <td align="left"><b>Campaign Image</b></td>
    <td align="left"><b>Campaign Created</b></td>
    <td align="left"><b>Campaign Updated</b></td>
    <td align="left"><b>Adsets</b></td>
    </tr>';

    while($row = mysqli_fetch_array($response)){
        echo '<tr><td align="left">' .
        $row['advertiser_id'] . '</td><td align="left">' .
        $row['campaign_id'] . '</td><td align="left">' .
        $row['campaign_name'] . '</td><td align="left">' .
        $row['campaign_profile_image'] . '</td><td align="left">' .
        $row['campaign_created'] . '</td><td align="left">' .
        $row['campaign_updated'] . '</td>' .
        '<td align="left"><form action="/adsets.php" method="get"><button name="campaign_id" type="submit" value='.
        $row['campaign_id'] . '>Button</button></form></td>';

        echo '</tr>';

    }
    echo '</table>';
} else {
    echo "Couldn't issue database query";

    echo mysqli_error($dbc);
}

mysqli_close();

?>
