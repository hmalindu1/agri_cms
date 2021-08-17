<?php include "includes/init.php"?>
<?php
if (isset($_GET['user'])) {
    $user = $_GET['user'];
    if (isset($_GET['code'])) {
        $code = $_GET['code'];
        $db_code = get_validationcode($user);
        if ($code == $db_code) {
            $_SESSION['message'] = "Codes match, activating user";
        } else {
            $_SESSION['message'] = "Validation code does not match the database";
            redirect('index.php');
        }

    } else {
        $_SESSION['message'] = "No validation code included with active request";
        redirect('index.php');
    }

} else {
    $_SESSION['message'] = "No user included with activate request";
    redirect('index.php');
}