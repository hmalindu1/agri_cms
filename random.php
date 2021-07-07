<?php
function return_x_or_o()
{
    if (rand(1, 10) > 5) {
        return "X";
    } else {
        return "O";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic-Tac_Toe</title>
</head>

<body>
    <table>
        <tr>
            <td><?php echo return_x_or_o(); ?></td>
            <td><?php echo return_x_or_o(); ?></td>
            <td><?php echo return_x_or_o(); ?></td>
        </tr>
        <tr>
            <td><?php echo return_x_or_o(); ?></td>
            <td><?php echo return_x_or_o(); ?></td>
            <td><?php echo return_x_or_o(); ?></td>
        </tr>
        <tr>
            <td><?php echo return_x_or_o(); ?></td>
            <td><?php echo return_x_or_o(); ?></td>
            <td><?php echo return_x_or_o(); ?></td>
        </tr>
    </table>
        <?php
if (isset($_GET['id'])) {
    echo $_GET['id'] . "<br>";
} else {
    echo "ID is not set<br>";
}
foreach ($_GET as $key => $val) {
    echo $key . " = " . $val . "<br>";
}
?>
</body>

</html>