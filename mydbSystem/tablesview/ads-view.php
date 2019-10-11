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

<a href="ads-view.php">Ads View</a>
<a href="ads.php">Ads List</a>

<h1>Ad VIEW</h1>

Adset ID: <?php echo  $_SESSION["adset_id"]; ?><br>
Adset Name: <?php echo $_SESSION["adset_name"]; ?><br>

<?php

$adset_id = $_SESSION["adset_id"];

require_once('../mysqli_connect.php');

$query = "SELECT ad_id, ad_width, ad_height, ad_type, ad_path, ad_created, ad_updated, adset_id FROM ads WHERE adset_id=$adset_id ORDER BY UNIX_TIMESTAMP(ad_updated) DESC";

$response = @mysqli_query($dbc, $query);

if($response){

    while($row = mysqli_fetch_array($response)){

        echo '<iframe src="http://localhost:8888/includes/' . $row['ad_path'] . '" height="'. $row['ad_height'] .'" width="'. $row['ad_width'] .'"></iframe>';

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
