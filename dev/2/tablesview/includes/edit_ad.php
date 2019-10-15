<?php

session_start();

$ad_id = $_GET["ad_id"];

echo 'ad is: ' . $ad_id;

// populate table
require_once('../../mysqli_connect.php');

$query = "SELECT ad_id, ad_width, ad_height, ad_type, ad_created, ad_updated FROM ads WHERE ad_id=$ad_id ";

$response = @mysqli_query($dbc, $query);

if($response){

    echo '<table align="left" cellspacing="5" cellpadding="8">

    <tr>
    <td align="left"><b>ad Width</b></td>
    <td align="left"><b>ad Height</b></td>
    <td align="left"><b>ad Type</b></td>
    <td align="left"><b>ad Created</b></td>
    <td align="left"><b>ad Updated</b></td>
    <td align="left"><b>Update ad</b></td>
    <td align="left"><b>Delete ad</b></td>
    <td align="left"><b>Back</b></td>
    </tr>';

    while($row = mysqli_fetch_array($response)){
    echo '<tr><form action="update_ad.php" method="POST">
          <input type="hidden" name="ad_id" value="'.
            $row['ad_id'] .'"/>
        <td align="left">
            <input type="text" name="ad_width" value="'.
            $row['ad_width'] .'"/>
        </td>
        <td align="left">
            <input type="text" name="ad_height" value="'.
            $row['ad_height'] .'"/>
        </td>
        <td align="left">
            <input type="text" name="ad_type" value="'.
            $row['ad_type'] .'"/>
        </td>
        <td align="left">' .
            $row['ad_created'] . '
        </td>
        <td align="left">' .
            $row['ad_updated'] . '
        </td>' .
        '<td align="left">
        <button type="submit">Update ad</button>
        </form>   
        </td>' .

        '<td align="left">
        <form action="delete_ad.php" method="POST">
        <input type="hidden" name="ad_id" value="'.
        $ad_id .'"/>
        <button type="submit">
        Delete ad
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
