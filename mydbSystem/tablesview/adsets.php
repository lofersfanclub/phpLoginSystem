<h1>ADSETS</h1>

Campaign ID: <?php echo $_GET["campaign_id"]; ?><br>
Campaign Name: <?php echo $_GET["campaign_name"]; ?><br>

<?php

$campaign_id = $_GET["campaign_id"];

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

?>

<form action="/campaigns.php">
<button>
back
</button>