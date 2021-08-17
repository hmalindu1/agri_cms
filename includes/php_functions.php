<?php
function redirect($loc)
{
    header("Location: {$loc}");
}

function generate_token()
{
    return md5(microtime() . mt_rand());
}

function count_field_val($pdo, $tbl, $fld, $val)
{
    try {
        $sql = "SELECT {$fld} FROM {$tbl} WHERE {$fld}=:value";
        $stmnt = $pdo->prepare($sql);
        $stmnt->execute([':value' => $val]);
        return $stmnt->rowCount();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function send_mail($to,$subject,$body,$from,$reply){
    $headers = "From: {$from}" . "\r\n" . "Reply-To: {$reply}" . "\r\n" . "X-Mailer:PHP/".phpversion();
    if ($_SERVER['SERVER_NAME'] != "localhost") {
        # code...
        mail($to,$subject,$body,$headers);
    } else {
        # code...
        echo "<hr><p>To: {$to}</p><p>Subject: {$subject}</p><p>{$body}</p><p>".$headers."</p></hr>";
    }
}

function get_validationcode($user)
{
    try {
        $sql = "SELECT validationcode FROM users WHERE username=:username";
        $stmnt = $pdo->prepare($sql);
        $stmnt->execute([':username' => $user]);
        $row = $stmnt -> fecth();
        return $row['validationcode'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
