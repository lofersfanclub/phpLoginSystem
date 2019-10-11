<?php 

$advertiser_id = 22;
$advertiser_name = "Toyota";
$campaign_id = 4;
$campaign_name = "C-HR";
$adset_id = 3;
$adset_name = "Privat";

function rmdir_recursive($dir) {
    foreach(scandir($dir) as $file) {
       if ('.' === $file || '..' === $file) continue;
       if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
       else unlink("$dir/$file");
   }

   rmdir($dir);
}

if($_FILES["zip_file"]["name"]) {
    $filename = $_FILES["zip_file"]["name"];
    $source = $_FILES["zip_file"]["tmp_name"];
    $type = $_FILES["zip_file"]["type"];

    $name = explode(".", $filename);
    $accepted_zip_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
    foreach($accepted_zip_types as $mime_type) {
        if($mime_type == $type) {
            $okay = true;
            $isZip = true;
            break;
        } 
    }
    $accepted_zip_types = array('image/jpg', 'image/jpeg', 'image/gif', 'image/png');
    foreach($accepted_zip_types as $mime_type) {
        if($mime_type == $type) {
            $okay = true;
            $isImage = true;
            break;
        } 
    }
    if($isImage){
        
        $message = "Image " . $isImage . var_dump($type);
        $ad_width = 500;
            $ad_height = 500;
            $ad_type = 'jpeg';
            $ad_name = $ad_width . 'x' . $ad_height; 

            $ad_name_no_wp = str_replace(" ","_",$ad_name);



            mkdir('ads/'. $advertiser_id . '/' . $campaign_id . '/'. $adset_id . '/' . $ad_name_no_wp, 0777, true);

            $target_dir = "ads/". $advertiser_id . '/' . $campaign_id . '/' . $adset_id . '/' . $ad_name_no_wp . '/';
            $target_file_wp = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $target_file = str_replace(" ","_",$target_file_wp);
            $uploadOk = 1;
            $file_extenstion = basename($_FILES["fileToUpload"]["name"]);
            $imageFileType = strtolower(pathinfo($file_extenstion,PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
                echo '<pre>';
                var_dump($target_file . $file_extenstion);
                echo '</pre>';

                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
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
                   $message =  "Uploaded";
                // if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

                //     $ad_profile_image_path = $target_file;

                //     $sql = "INSERT INTO ads (ad_width, ad_height, ad_type, ad_path, ad_created, ad_updated, adset_id) VALUES ('$ad_width', '$ad_height', '$ad_type', '$ad_profile_image_path', NOW(), NOW(), '$adset_id')";

                //     $response = @mysqli_query($dbc, $sql);

                //     if($response){

                //     } else {
                //         echo "Couldn't issue database query";

                //         echo mysqli_error($dbc);
                //     }

                //     mysqli_close();
                //     header("Location: ../ads.php");

                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
}
    }
    else if($isZip){
        $continue = strtolower($name[1]) == 'zip' ? true : false;
    if(!$continue) {
        $message = "The file you are trying to upload is not a .zip file. Please try again.";
    }
    else{
        /* PHP current path */
    $path = dirname(__FILE__).'/';  // absolute path to the directory where zipper.php is in
    $filenoext = basename ($filename, '.zip');  // absolute path to the directory where zipper.php is in (lowercase)
    $filenoext = basename ($filenoext, '.ZIP');  // absolute path to the directory where zipper.php is in (when uppercase)

    $targetdir = $advertiser_id . '/' . $campaing_id . '/' . $filenoext; // target directory
    $targetzip = $path . $filename; // target zip file

    /* create directory if not exists', otherwise overwrite */
    /* target directory is same as filename without extension */

    if (is_dir($targetdir))  rmdir_recursive ( $targetdir);


    mkdir($targetdir, 0777);


    /* here it is really happening */

        if(move_uploaded_file($source, $targetzip)) {
            $zip = new ZipArchive();
            $x = $zip->open($targetzip);  // open the zip file to extract
            if ($x === true) {
                $zip->extractTo($targetdir); // place in the directory with same name  
                $zip->close();

                unlink($targetzip);
            }
            $message = "Your .zip file was uploaded and unpacked.";
        } else {    
            $message = "There was a problem with the upload. Please try again.";
        }
    }
    }
    else{
        $message = "This file is not possible to upload" . var_dump($type); 
    }  
}


?>

<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Unzip a zip file to the webserver</title>
</head>

<body>
    <?php if($message) echo "<p>$message</p>"; ?>
    <form enctype="multipart/form-data" method="post" action="">
        <label>Choose a zip file to upload: <input type="file" name="zip_file" /></label>
        <br />
        <input type="submit" name="submit" value="Upload" />
    </form>
</body>

</html>