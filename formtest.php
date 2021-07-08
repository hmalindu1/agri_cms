<?php
if (isset($_POST['username'])) {
    $username = $_POST['username'];
} else {
    $username = "";
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
} else {
    $password = "";
}
echo "SELECT username,password FROM users WHERE useranem='{$username}' AND password='{$password}'";

foreach ($_SERVER as $key => $val) {
    echo "<br>{$key} = {$val}";
}

?>
<form action="form_handler.php" method="post">
    Username: <br>
    <input type="text" name="username"><br>
    Password: <br>
    <input type="password" name="password"><br>
    <input type="submit" name="submit" value="Submit">
</form>
