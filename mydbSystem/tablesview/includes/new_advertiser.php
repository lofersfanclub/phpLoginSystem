<?php

require_once('../../mysqli_connect.php');

$advertiser_name = $_POST['advertiser_name'];

$advertiser_name_no_wp = str_replace(" ","_",$advertiser_name);

mkdir('profile_img/' . $advertiser_name_no_wp, 0777, true);

$target_dir = "profile_img/" . $advertiser_name_no_wp . '/';
$target_file_wp = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file = str_replace(" ","_",$target_file_wp);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
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
                echo "Advertiser name is: " . $advertiser_name . ". Profile image path is: " . $target_dir . $target_file;

                $advertiser_profile_image_path = $target_dir . $target_file;

                $sql = "INSERT INTO advertisers (advertiser_name, advertiser_profile_image, advertiser_created, advertiser_updated) VALUES ('$advertiser_name', '$advertiser_profile_image_path', NOW(), NOW())";

                $response = @mysqli_query($dbc, $sql);

                if($response){

                } else {
                    echo "Couldn't issue database query";

                    echo mysqli_error($dbc);
                }

                mysqli_close();
                header("Location: ../index.php");

            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
        $advertiser_profile_image_path = $target_dir . $target_file;

        $sql = "INSERT INTO advertisers (advertiser_name, advertiser_updated) VALUES ('$advertiser_name', NOW())";

        $response = @mysqli_query($dbc, $sql);

        if($response){

        } else {
            echo "Couldn't issue database query";

            echo mysqli_error($dbc);
        }

        mysqli_close();
        header("Location: ../index.php");
    }
}

?>
