<?php

function escapeString($string) {
    return Db::get()->real_escape_string($string);
}

function redirect($url) {
    header("Location: $url");
    exit;
}

function passwordHash($password) {
    $p = $password . PASSWORD_SALT;
    for ($i = 0; $i < 5000; $i++) {
        $p = sha1($p);
    }
    return $p;
}

function sendEmail($to, $subject, $body) {
    $mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'diba.otana.org';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'info@diba.otana.org';                 // SMTP username
    $mail->Password = '1234@qaz';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('info@diba.otana.org', 'Shop');
    $mail->addAddress($to);               // Name is optional

    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $subject;
    $mail->Body = $body;

    return $mail->send();
}

function addFlashMessage($message) {
    if (!isset($_SESSION['flash-messages'])) {
        $_SESSION['flash-messages'] = [];
    }
    $_SESSION['flash-messages'][] = $message;
}

function getFlashMessages() {
    if (!isset($_SESSION['flash-messages'])) {
        return [];
    }
    $messages = $_SESSION['flash-messages'];
    $_SESSION['flash-messages'] = [];
    return $messages;
}
