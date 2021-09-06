<?php include "includes/init.php"?>
<?php
if (logged_in()) {
    $username = $_SESSION['username'];
} else {
    redirect('index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
    <?php include "includes/header.php"?>
    <body>
        <?php include "includes/nav.php"?>

        <div class="container">
            <?php
show_msg();
?>
            <h1 class="text-center"><?php echo $username ?>'s content</h1>
                    <?php
try {
    $sql = "SELECT u.username, g.name AS group_name, g.descr AS group_descr, p.name AS page_name, p.descr AS page_descr, p.url ";
    $sql .= "FROM users u ";
    $sql .= "JOIN user_group_link gu ON u.id = gu.user_id ";
    $sql .= "JOIN groups g ON gu.group_id = g.id ";
    $sql .= "JOIN pages p ON g.id = p.group_id ";
    $sql .= "WHERE username = '{$username}' ";
    $sql .= "ORDER BY group_name";
    $result = $pdo->query($sql);
    if ($result->rowCount() > 0) {
        $prev_group = " ";
        echo "<table class=table>";
        foreach ($result as $row) {
            if ($prev_group != $row['group_name']) {
                echo "<tr><td>{$row['group_name']}</td><td>{$row['group_descr']}</td></tr>";
            }
            echo "<tr><td> </td><td><a href='content/{$row['url']}'>{$row['page_name']}</a></td><td>{$row['page_descr']}</td></tr>";
            $prev_group = $row['group_name'];
        }
        echo "</table>";
    } else {
        echo "<h4>No content available for {$username}</h4>";
    }
} catch (PDOException $e) {
    echo "Oops! There was an Error <br><br>" . $e->getMessage() . "<br>";
    echo "Line Number: " . $e->getLine();
}
?></div> <!--Container-->

        <?php include "includes/footer.php"?>
    </body>
</html>