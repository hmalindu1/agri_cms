<?php include "includes/init.php"?>
<?php
if ($_GET['user']) {
    if ($_GET['code']) {
        $username = $_GET['user'];
        $vcode = $_GET['code'];
        if (count_field_val($pdo, "users", "username", $username) > 0) {
            $row = return_field_data($pdo, "users", "username", $username);
            if ($vcode != $row['validationcode']) {
                set_msg("Validation code does not match database");
                redirect("index.php");
            }
        } else {
            set_msg("User '{$username}' not found in database");
            redirect("index.php");
        }
    } else {
        set_msg("No validation code included with reset request");
        redirect("index.php");
    }
} else {
    set_msg("No user included with reset request");
    redirect("index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"?>

<body>
    <?php include "includes/nav.php"?>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <?php
show_msg();
?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="register-form" method="post" role="form">
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="5" class="form-control" placeholder="New Password" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password_confirm" id="confirm-password" tabindex="6" class="form-control" placeholder="Confirm Password" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-custom" value="Reset Password">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/footer.php"?>
</body>

</html>