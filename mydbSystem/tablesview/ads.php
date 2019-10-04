<?php
// Start the session
session_start();

if($_SESSION["adset_id"] == null){
    $_SESSION["adset_id"] = $_GET["adset_id"];
    $_SESSION["adset_name"] = $_GET["adset_name"];
}

if($_SESSION["ad_id"] == !null){
    $_SESSION["ad_id"] = null;
}

?>

<h1>ADS</h1>

Adset ID: <?php echo  $_SESSION["adset_id"]; ?><br>
Adset Name: <?php echo $_SESSION["adset_name"]; ?><br>

<table align="left" cellspacing="5" cellpadding="8">
    <tr>
        <td align="left" style="opacity:0"><b>Ad ID</b></td>
        <td align="left"><b>Ad Width</b></td>
        <td align="left"><b>Ad Height</b></td>
        <td align="left"><b>Ad Type</b></td>
        <td align="left"><b>Add New Ad</b></td>
    </tr>
    <tr>
        <form action="includes/new_ad.php" method="POST">
            <td align="left"></td>
            <td align="left"><b><input type="text" name="ad_width" placeholder="New Ad Width"></input></b></td>
            <td align="left"><b><input type="text" name="ad_height" placeholder="New Ad Height"></input></b></td>
            <td align="left"><b><input type="text" name="ad_type" placeholder="New Ad Type"></input></b></td>
            <td align="left"><b><button type="submit" name="submit">New Ad</button></b></td>
        </form>
    </tr>
</table>

<?php

$adset_id = $_SESSION["adset_id"];

require_once('../mysqli_connect.php');

$query = "SELECT ad_id, ad_width, ad_height, ad_type, ad_created, ad_updated, adset_id FROM ads WHERE adset_id=$adset_id";

$response = @mysqli_query($dbc, $query);

print_r($_SESSION);

if($response){

    echo '<table align="left" cellspacing="5" cellpadding="8">

    <tr>
    <td align="left"><b>Adest ID</b></td>
    <td align="left"><b>Ad ID</b></td>
    <td align="left"><b>Ad Width</b></td>
    <td align="left"><b>Ad Height</b></td>
    <td align="left"><b>Ad Type</b></td>
    <td align="left"><b>Ad Created</b></td>
    <td align="left"><b>Ad Updated</b></td>
    <td align="left"><b>Edit Ad</b></td>
    </tr>';

    while($row = mysqli_fetch_array($response)){
        echo '<tr><td align="left">' .
        $row['adset_id'] . '</td><td align="left">' .
        $row['ad_id'] . '</td><td align="left">' .
        $row['ad_width'] . '</td><td align="left">' .
        $row['ad_height'] . '</td><td align="left">' .
        $row['ad_type'] . '</td><td align="left">' .
        $row['ad_created'] . '</td><td align="left">' .
        $row['ad_updated'] . '</td>' .
        '<td align="left">
        <form action="includes/edit_ad.php" method="get">
        <button name="ad_id"
        type="submit"
        value='. $row['ad_id'] . '>
        Edit Ad
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

echo '<form action="/adsets.php" metode="POST">
    <input type="hidden" name="campaign_id" value="'. 
    $campaign_id .'"/>
    <input type="hidden" name="campaign_id" value="'. 
    $campaign_name .'"/>
    <button>back</button>
</form>';

?>
