<?php
$myDB = new mysqli('localhost', 'root', '', 'mhiudemo');

if ($myDB->connect_error) {
    die('Connect Error (' . $myDB->connect_errno . ')' . $myDB->connect_error);
}

$sql = "SELECT * FROM listShop WHERE available = 1 ";
$result = $myDB->query($sql);
?>

<h1>Hoang Minh Hieu test ❤️</h1>;

<table cellSpacing="3" cellPadding="10" align="center" border="8">
    <tr> 
        <td colspan="4">
            <h2 align="center">Shop In4</h2>
        </td>
    </tr>
    <tr>
        <td align="center">Shop</td>
        <td align="center">Tel</td>
        <td align="center">Address</td>
    </tr>
    <?php
    While ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>";
        // echo stripslashes($row["title"]);
        echo stripslashes($row["name"]);
        echo "</td><td align='center'>";
        echo $row["tel"];
        echo "</td><td>";
        echo $row["address"];
        echo "</td>";
        echo "</tr>";
    }
    ?>
</table>


?>