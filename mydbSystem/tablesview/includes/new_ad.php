<?php

session_start();

$advertiser_id = $_SESSION["advertiser_id"];
$advertiser_name = $_SESSION["advertiser_name"];
$campaign_id = $_SESSION["campaign_id"];
$campaign_name = $_SESSION["campaign_name"];
$adset_id = $_SESSION["adset_id"];
$adset_name = $_SESSION["adset_name"];

echo '<pre>';
var_dump($_SESSION);
echo '</pre>';

require_once('../../mysqli_connect.php');

$ad_width = $_POST["ad_width"];
$ad_height = $_POST["ad_height"];
$ad_type = $_POST["ad_type"];
$ad_name = $ad_width . 'x' . $ad_height; 

$ad_name_no_wp = str_replace(" ","_",$ad_name);



mkdir('ads/'. $advertiser_id . '/' . $campaign_id . '/' . $ad_name_no_wp, 0777, true);

$target_dir = "ads/". $advertiser_id . '/' . $adset_id . '/' . $ad_name_no_wp . '/';
$target_file_wp = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file = str_replace(" ","_",$target_file_wp);
$uploadOk = 1;
$file_extenstion = basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($file_extenstion,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {

    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];

    echo '<pre>';
    var_dump($fileName);
    echo '</pre>';

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        echo "ad name is: " . $ad_name . ". Profile image path is: ". $target_file;

        $ad_profile_image_path = $target_file;

$sql = "INSERT INTO ads (ad_width, ad_height, ad_type, ad_path, ad_created, ad_updated, adset_id) VALUES ('$ad_width', '$ad_height', '$ad_type', '$ad_profile_image_path', NOW(), NOW(), '$adset_id')";

        $response = @mysqli_query($dbc, $sql);

        if($response){

        } else {
            echo "Couldn't issue database query";

            echo mysqli_error($dbc);
        }

        mysqli_close();
        header("Location: ../ads.php");

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
