<?php include "../includes/init.php";?>
<?php
if (logged_in()) {
    $username = $_SESSION['username'];
    if (!verify_user_group($pdo, $username, "Admin")) {
        set_msg("User '{$username}' does not have permission to view this page");
        redirect('../index.php');
    }
} else {
    set_msg("Please log-in and try again");
    redirect('../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <?php include "../includes/header.php"?>
    <body>
        <?php include "../includes/nav.php"?>

        <div class="container">
            <h1 class="text-center">Admin</h1>
            <ul class="nav nav-tabs">
                  <li id="users" class="tab-label active"><a href="#">Users</a></li>
                  <li id="groups" class="tab-label"><a href="#">Groups</a></li>
                  <li id="pages" class="tab-label"><a href="#">Pages</a></li>
            </ul>
            <div id='tab-users' class='tab-content'>
                <?php
try {
    $result = $pdo->query("SELECT id,firstname, lastname, username, email, active, joined, last_login FROM users");
    if ($result->rowCount() > 0) {
        echo "<table class=table>";
        echo "<tr><th>ID</th><th>First_Name</th><th>Last_Name</th><th>User_Name</th><th>Email</th><th>Active</th><th>Joined</th><th>Last login</th></tr>";
        foreach ($result as $row) {
            if ($row['active']==1) {
                $active = "yes";
                $action = "Deactivate";
            } else {
                $active = "No";
                $action = "Activate";
            }

            echo "<tr><td>{$row['id']}</td><td>{$row['firstname']}</td>
            <td>{$row['lastname']}</td><td>{$row['username']}</td>
            <td>{$row['email']}</td><td>{$active}</td>
            <td>{$row['joined']}</td>
            <td>{$row['last_login']}</td>
            <td><a href='admin_deactivate_users.php?id={$row['id']}'>{$action}</a></td>
            <td><a href='admin_edit_users.php?id={$row['id']}'>Edit</a></td>
            <td><a class='confirm-delete' href='admin_delete.php?id={$row['id']}&tbl=users'>Delete</a></td></tr>";
        }
        echo "</table>";
    } else {
        echo "No users in the users table";
    }
} catch (PDOException $e) {
    echo "Oops! There was an Error <br><br>" . $e->getMessage() . "<br>";
    echo "Line Number: " . $e->getLine();
}
?>
            </div>
            <div id='tab-groups' class='tab-content'>
                <?php
try {
    $result = $pdo->query("SELECT id, name, descr  FROM groups ORDER BY name");
    if ($result->rowCount() > 0) {
        echo "<table class=table>";
        echo "<tr><th>ID</th><th>Name</th><th>Description</th><th>Users</th><th>Pages</th></tr>";
        foreach ($result as $row) {
            $user_count = count_field_val($pdo, "user_group_link", "group_id", $row['id']);
            $page_count = count_field_val($pdo, "pages", "group_id", $row['id']);
            echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['descr']}</td><td>{$user_count}</td><td>{$page_count}</td><td><a href='admin_manage_users.php?id={$row['id']}'>Manage Users</a></td></tr>";
        }
        echo "</table>";
    } else {
        echo "<br> No groups in the groups table <br><br>";
    }
} catch (PDOException $e) {
    echo "Oops! There was an Error <br><br>" . $e->getMessage() . "<br>";
    echo "Line Number: " . $e->getLine();
}
?>
                <a href='admin_add_group.php' class="btn btn-success">Add Group</a>
            </div>
            <div id='tab-pages' class='tab-content'>
                <?php
try {
    $result = $pdo->query("SELECT id, name, url, group_id, descr FROM pages ORDER BY name");
    if ($result->rowCount() > 0) {
        echo "<table class=table>";
        echo "<tr><th>ID</th><th>Name</th><th>URL</th><th>Group Name</th><th>Description</th></tr>";
        foreach ($result as $row) {
            $group_row = return_field_data($pdo, "groups", "id", $row['group_id']);
            echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['url']}</td><td>{$group_row['name']}</td><td>{$row['descr']}</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<br> No pages in the pages table <br><br>";
    }
} catch (PDOException $e) {
    echo "Oops! There was an Error <br><br>" . $e->getMessage() . "<br>";
    echo "Line Number: " . $e->getLine();
}
?>
                <a href='admin_add_page.php' class="btn btn-success">Add Page</a>
            </div>
        </div> <!--Container-->
        <?php include "../includes/footer.php"?>
        <script>
            if (getParameterByName("tab")){
                gotoTab(getParameterByName("tab"));
            } else {
                gotoTab("users");
            }
            $(".tab-label").click(function(){
                gotoTab($(this).attr('id'));
            });
            function gotoTab(label){
                var current_tab="#tab-"+label;
                console.log("'"+current_tab+"'");
                $(".tab-content").hide();
                $(".tab-label").removeClass("active");
                $(current_tab).show();
                $("#"+label).addClass("active");
            }
        </script>
    </body>
</html>