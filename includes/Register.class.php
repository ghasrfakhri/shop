<?php

class Register {

    public function create($email, $password, $firstname, $lastname) {
        $password2 = passwordHash($password);
        $query = "INSERT INTO user SET "
                . "email='$email', password='$password2', "
                . "firstname='$firstname', lastname='$lastname'";

        Db::get()->query($query);

        return Db::get()->insert_id;
    }

    public function passwordResetRequest($email) {
        $query = "SELECT id FROM user WHERE email='$email'";
        $result = Db::get()->query($query);
        list($id) = $result->fetch_row();

        if ($id) {
            $token = $this->createToken($id);
            $this->saveToken($id, $token);
            $this->emailResetPasswordToken($id, $email, $token);
        }
    }

    public function setPassword($id, $password) {
        $query = "UPDATE user SET password='$password' WHERE id=$id";
        Db::get()->query($query);
    }

    public function removeToken($id, $token) {
        $query = "DELETE FROM user_token WHERE "
                . "         user_id='$id' AND token='$token'";
        Db::get()->query($query);
    }

    public function isValidToken($id, $token) {
        $query = "SELECT COUNT(*) FROM user_token WHERE "
                . "         user_id='$id' AND token='$token' AND ADDDATE(create_at, INTERVAL 24 HOUR )> NOW()";
        $result = Db::get()->query($query);
        list($c) = $result->fetch_row();
        if ($c > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function createToken($id) {
        $token = sha1(time());


        return $token;
    }

    private function saveToken($id, $token) {
        $query = "INSERT INTO user_token SET user_id=$id, token='$token'";
        Db::get()->query($query);
    }

    private function emailResetPasswordToken($id, $email, $token) {
        $url = "http://localhost:8080/shop/password-reset.php?token=$token&id=$id";
        $subject = "Reset Password";
        $body = <<<msg
Please click on the following link for resetting password:                <br>
$url<br>
                <br>
                <br>
                <br>
msg;

        echo $body;
        return;
        sendEmail($email, $subject, $body);
    }

}
