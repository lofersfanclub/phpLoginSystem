<?php
// Start the session
session_start();

if($_SESSION["campaign_id"] == null){
    $_SESSION["campaign_id"] = $_GET["campaign_id"];
    $_SESSION["campaign_name"] = $_GET["campaign_name"];
}

if($_SESSION["adset_id"] == !null){
    $_SESSION["adset_id"] = null;
    $_SESSION["adset_name"] = null;
}

?>


<h1>ADSETS</h1>

Campaign ID: <?php echo $_GET["campaign_id"]; ?><br>
Campaign Name: <?php echo $_GET["campaign_name"]; ?><br>

<table align="left" cellspacing="5" cellpadding="8">
    <tr>
        <td align="left" style="opacity:0"><b>Adset ID</b></td>
        <td align="left"><b>Adset Name</b></td>
        <td align="left"><b>Add New Adset</b></td>
    </tr>
    <tr>
        <form action="includes/new_adset.php" method="POST">
            <td align="left"></td>
            <td align="left"><b><input type="text" name="adset_name" placeholder="New Adset Name"></input></b></td>
            <td align="left"><b><button type="submit" name="submit">New Adset</button></b></td>
        </form>
    </tr>
</table>

<?php

$campaign_id =     $_SESSION["campaign_id"];
$campaign_name = $_SESSION["campaign_name"];

print_r($_SESSION);

require_once('../mysqli_connect.php');

$query = "SELECT adset_id, adset_name, adset_created, adset_updated, campaign_id FROM adsets WHERE campaign_id=$campaign_id";

$response = @mysqli_query($dbc, $query);

if($response){

    echo '<table align="left" cellspacing="5" cellpadding="8">

    <tr>
    <td align="left"><b>Campaign ID</b></td>
    <td align="left"><b>Adset ID</b></td>
    <td align="left"><b>Adset Name</b></td>
    <td align="left"><b>Adset Created</b></td>
    <td align="left"><b>Adset Updated</b></td>
    <td align="left"><b>Ads</b></td>
    </tr>';

    while($row = mysqli_fetch_array($response)){
        echo '<tr><td align="left">' .
        $row['campaign_id'] . '</td><td align="left">' .
        $row['adset_id'] . '</td><td align="left">' .
        $row['adset_name'] . '</td><td align="left">' .
        $row['adset_created'] . '</td><td align="left">' .
        $row['adset_updated'] . '</td>' .
        '<td align="left">
        <form action="/ads.php" method="get">
        <input type="hidden" name="adset_name" value="'. 
        $row['adset_name'] .'"/>
        <button name="adset_id" type="submit" value='.
        $row['adset_id'] . 
        '>View Ads</button>
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

echo '<form action="/campaigns.php" metode="POST">
    <input type="hidden" name="campaign_id" value="'. 
    $campaign_id .'"/>
    <input type="hidden" name="campaign_id" value="'. 
    $campaign_name .'"/>
    <button>back</button>
</form>';

?>

