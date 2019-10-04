<?php
// Start the session
session_start();
    $_SESSION["advertiser_id"] = null;
    $_SESSION["advertiser_name"] = null;
?>

<html>
<body>

<h1>ADVERTISERS</h1>

<table align="left" cellspacing="5" cellpadding="8">
    <tr>
        <td align="left" style="opacity:0"><b>Advertiser ID</b></td>
        <td align="left"><b>Advertiser Name</b></td>
        <td align="left"><b>Advertiser Image</b></td>
        <td align="left"><b>Add New Advertiser</b></td>
    </tr>
    <tr>
        <form action="includes/new_advertiser.php" method="POST">
            <td align="left"></td>
            <td align="left"><b><input type="text" name="advertiser_name" placeholder="New Advertiser Name"></input></b></td>
            <td align="left"><b><input type="text" name="advertiser_profile_image" placeholder="http://dummyimage.com/400x400.jpg/ff4444/ffffff" style="width:340px"></input></b></td>
            <td align="left"><b><button type="submit" name="submit">New Advertiser</button></b></td>
        </form>
    </tr>
</table>

<?php

// populate table
require_once('../mysqli_connect.php');

$query = "SELECT advertiser_id, advertiser_name, advertiser_profile_image, advertiser_created, advertiser_updated FROM advertisers ORDER BY UNIX_TIMESTAMP(advertiser_updated)";

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
    <td align="left"><b>Edit Advertiser</b></td>
    </tr>';

    while($row = mysqli_fetch_array($response)){
        echo '<tr><td align="left">' .
        $row['advertiser_id'] . '</td><td align="left">' .
        $row['advertiser_name'] . '</td><td align="left">' .
        $row['advertiser_profile_image'] . '</td><td align="left">' .
        $row['advertiser_created'] . '</td><td align="left">' .
        $row['advertiser_updated'] . '</td>' .
        '<td align="left">
        <form action="/campaigns.php" method="get">
        <input type="hidden" name="advertiser_name" value="'.
        $row['advertiser_name'] .'"/>
        <button name="advertiser_id"
        type="submit"
        value='. $row['advertiser_id'] . '>
        View Campaigns
        </button>
        </form>
        </td>' .
        '<td align="left">
        <form action="includes/edit_advertiser.php" method="get">
        <button name="advertiser_id"
        type="submit"
        value='. $row['advertiser_id'] . '>
        Edit Advertiser
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

</body>
</html>