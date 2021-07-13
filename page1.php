<?php
$dsn = "pgsql:host=localhost;dbname=agri_users;port=5432";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
$pdo = new PDO($dsn, 'postgres', '123', $opt);
echo "Connected to Database";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"?>

<body>
    <?php include "includes/nav.php"?>

    <div class="container">
        <h1 class="text-center">Page 1</h1>
        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. "</p>

        <br>
        <?php
$result = $pdo->query("SELECT * FROM users");
if ($result->rowCount() > 0) {
    echo "<table class=table>";
    echo "<tr><th>First_Name</th><th>Last_Name</th><th>User_Name</th><th>Password</th></tr>";
    foreach ($result as $row) {
        echo $row['firstname'];
    }
    echo "</table>";
} else {
    echo "No users in the users table"; 
}
?>

    </div>
    <!--Container-->

    <?php include "includes/footer.php"?>
</body>

</html>