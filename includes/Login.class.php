<?php

class Login {

    public function doLogin($email, $password, $rememberMe = false) {
        $password2 = passwordHash($password);
        $query = "SELECT * FROM user WHERE email='$email' AND password='$password2'";
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

    public function logout() {
        unset($_SESSION['user']);
        unset($_SESSION['userId']);
    }

    public function isLogin() {
        if (isset($_SESSION['userId']) && !empty($_SESSION['userId'])) {
            $_SESSION['user'] = $this->getUser($_SESSION['userId']);
            return true;
        } else {
            if (isset($_COOKIE['userId']) && $_COOKIE['secret']) {
                $user = $this->getUser($_COOKIE['userId']);
                if ($_COOKIE['secret'] === $this->getSecretHash($user)) {
                    $_SESSION['userId'] = $_COOKIE['userId'];
                    $_SESSION['user'] = $this->getUser($_SESSION['userId']);
                    return true;
                }
            }
        }

        return false;
    }

    public function isGranted($role) {
        if (!$this->isLogin()) {
            return false;
        }

        $user = $_SESSION['user'];
        $roles = unserialize($user['roles']);
        return in_array($role, $roles);
    }

    public function getCurrentUser() {
        if ($this->isLogin()) {
            return $_SESSION['user'];
        }
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
