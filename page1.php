<?php include "includes/init.php"?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"?>

<body>
    <?php include "includes/nav.php"?>

    <div class="container">
        <?php
            echo generate_token() . "<br>";
            echo count_field_val($pdo, "users", "username", "hmalindu1") . "<br>";
        ?>
        <h1 class="text-center">Page 1</h1>
        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. "</p>

        <br>
        <?php
try {
    $result = $pdo->query("SELECT firstname, lastname, username, password FROM users");
    if ($result->rowCount() > 0) {
        echo "<table class=table>";
        echo "<tr><th>First_Name</th><th>Last_Name</th><th>User_Name</th><th>Password</th></tr>";
        foreach ($result as $row) {
            echo "<tr><td>{$row['firstname']}</td><td>{$row['lastname']}</td><td>{$row['username']}</td><td>{$row['password']}</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No users in the users table";
    }
} catch (PDOException $e) {
    echo "Oops! There was an Error <br><br>" . $e->getMessage();
}
?>

    </div>
    <!--Container-->

    <?php include "includes/footer.php"?>
</body>

</html>