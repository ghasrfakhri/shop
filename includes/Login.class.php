<?php

class Login {

    public function doLogin($email, $password, $rememberMe = false) {

        $query = "SELECT * FROM user WHERE email='$email' AND password='$password'";
        $result = Db::get()->query($query);

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $_SESSION['userId'] = $user['id'];

            if ($rememberMe == true) {
                setcookie("userId", $user['id'], time() + 3600 * 24 * 14, "/");
                setcookie("secret", $this->getSecretHash($user), time() + 3600 * 24 * 14, "/");
            }
            return true;
        } else {
            return false;
        }
    }

    public function isLogin() {
        if (isset($_SESSION['userId']) && !empty($_SESSION['userId'])) {
            return true;
        } else {
            if (isset($_COOKIE['userId']) && $_COOKIE['secret']) {
                $user = $this->getUser($_COOKIE['userId']);
                if ($_COOKIE['secret'] === $this->getSecretHash($user)) {
                    $_SESSION['userId'] = $_COOKIE['userId'];
                    return true;
                }
            }
        }

        return false;
    }

    private function getSecretHash($user) {
        return sha1(md5($user['email']) . $user['password']);
    }

    private function getUser($userId) {
        $query = "SELECT * FROM user WHERE id=$userId";
        $result = Db::get()->query($query);
        return $result->fetch_assoc();
    }

}
