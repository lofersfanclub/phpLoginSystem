<html>
<body>

<h1>TNO Creatives</h1>

<?php

// populate table
require_once('../mysqli_connect.php');

$query = "SELECT Reporting_Label FROM Toyota_Norway_Retargeting_2018";

$response = @mysqli_query($dbc, $query);

if($response){

    echo '<h2>Pre-selected Option</h2>
<p>You can preselect an option with the selected attribute.</p>
<form action="/action_page.php"><select name="cars">';

    while($row = mysqli_fetch_array($response)){
        echo '<option value="' .
        $row['Reporting_Label'] . '">' . $row['Reporting_Label'] .'</option>';
    }
    echo '</select>
          <br><br>
          <input type="submit">
          </form>';

} else {
    echo "Couldn't issue database query";

    echo mysqli_error($dbc);
}

mysqli_close();


?>

</body>
</html>
