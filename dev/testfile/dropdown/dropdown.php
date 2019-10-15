<html>  
    <head>  
    <title>Dynamic Drop Down List</title>  
    </head>  
    <BODY bgcolor ="pink">  

    
    <?php
$cars=array("Volvo","BMW","Toyota");
$arr[] = 56;
$arrlength=count($cars);
?>

    <?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "tapnordic_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, campaign_name, car_model FROM campaign";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["campaign_name"]. " - Model: " . $row["car_model"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>


        <form id="r" method="post">
   <select name="size">
<?php
for($x=0;$x<$arrlength;$x++)
  {
  $add = $cars[$x];    
  echo "<option value=";
  echo $add;
  echo ">";
  echo $add;
  echo "</option>";
  }
?>
  </select> 
<input type="submit" name="Submit" value="Send">
</form>

<?php
if(isset($_POST['size'])) {
  echo "selected size: ".htmlspecialchars($_POST['size']);
}
?>

    </body>  
</html> 

