<?php
// Start the session
session_start();

if($_SESSION["advertiser_id"] == null){
    $_SESSION["advertiser_id"] = $_GET["advertiser_id"];
    $_SESSION["advertiser_name"] = $_GET["advertiser_name"];
}

if($_SESSION["campaign_id"] == !null){
    $_SESSION["campaign_id"] = null;
    $_SESSION["campaign_name"] = null;
}

?>

<h1>CAMPAIGNS</h1>

Advertiser ID: <?php echo $_SESSION["advertiser_id"] ; ?><br>
Advertiser Name: <?php echo $_SESSION["advertiser_name"]; ?><br>

<table align="left" cellspacing="5" cellpadding="8">
    <tr>
        <td align="left" style="opacity:0"><b>Campaign ID</b></td>
        <td align="left"><b>Campaign Name</b></td>
        <td align="left"><b>Campaign Image</b></td>
        <td align="left"><b>Add New Campaign</b></td>
    </tr>
    <tr>
        <form action="includes/new_campaign.php" method="POST">
            <td align="left"></td>
            <td align="left"><b><input type="text" name="campaign_name" placeholder="New Campaign Name"></input></b></td>
            <td align="left"><b><input type="text" name="campaign_profile_image" placeholder="http://dummyimage.com/400x400.jpg/ff4444/ffffff" style="width:340px"></input></b></td>
            <td align="left"><b><button type="submit" name="submit">New Campaign</button></b></td>
        </form>
    </tr>
</table>

<?php

$adver_id = $_SESSION["advertiser_id"];

print_r($_SESSION);

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
    <td align="left"><b>Edit Campaign</b></td>
    </tr>';

    while($row = mysqli_fetch_array($response)){
        echo '<tr><td align="left">' .
        $row['advertiser_id'] . '</td><td align="left">' .
        $row['campaign_id'] . '</td><td align="left">' .
        $row['campaign_name'] . '</td><td align="left">' .
        $row['campaign_profile_image'] . '</td><td align="left">' .
        $row['campaign_created'] . '</td><td align="left">' .
        $row['campaign_updated'] . '</td>' .
        '<td align="left">
        <form action="/adsets.php" method="get">
        <input type="hidden" name="campaign_name" value="'.
        $row['campaign_name'] .'"/>
        <button name="campaign_id" type="submit" value='.
        $row['campaign_id'] .
        '>View Adsets</button>
        </form>
        </td>' .
        '<td align="left">
        <form action="includes/edit_campaign.php" method="get">
        <button name="campaign_id"
        type="submit"
        value='. $row['campaign_id'] . '>
        Edit Campaign
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

<form action="/index.php">
<button>
back
</button>
