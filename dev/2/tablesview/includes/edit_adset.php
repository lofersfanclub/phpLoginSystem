<?php

$adset_id = $_GET["adset_id"];

echo 'adset is: ' . $adset_id;

// populate table
require_once('../../mysqli_connect.php');

$query = "SELECT adset_id, adset_name, adset_created, adset_updated FROM adsets WHERE adset_id=$adset_id ";

$response = @mysqli_query($dbc, $query);

if($response){

    echo '<table align="left" cellspacing="5" cellpadding="8">

    <tr>
    <td align="left"><b>adset Name</b></td>
    <td align="left"><b>adset Created</b></td>
    <td align="left"><b>adset Updated</b></td>
    <td align="left"><b>Update adset</b></td>
    <td align="left"><b>Delete adset</b></td>
    <td align="left"><b>Back</b></td>
    </tr>';

    while($row = mysqli_fetch_array($response)){
    echo '<form action="update_adset.php" method="POST">
          <input type="hidden" name="adset_id" value="'.
            $row['adset_id'] .'"/>
        <tr><td align="left">
            <input type="text" name="adset_name" value="'.
            $row['adset_name'] .'"/>
        </td>
        <td align="left">' .
            $row['adset_created'] . '
        </td>
        <td align="left">' .
            $row['adset_updated'] . '
        </td>' .
        '<td align="left">
        <button type="submit">Update adset</button>
        </form>   
        </td>' .

        '<td align="left">
        <form action="delete_adset.php" method="POST">
        <input type="hidden" name="adset_id" value="'.
        $adset_id .'"/>
        <button type="submit">
        Delete adset
        </button>
        </form>
        </td>
        <td align="left">
        <form action="/index.php">
        <button>
        cancel
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
