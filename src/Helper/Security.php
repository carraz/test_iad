<?php

namespace Helper;

use Model\User;

class Security
{
    private $sessionStarted;

    public function __construct()
    {
        $this->sessionStarted = false;
    }

    /**
     * @throws \Exception
     */
    public function startSession()
    {
        if ($this->sessionStarted) {
            return;
        }
        $this->sessionStarted = session_start();

        if (!$this->sessionStarted) {
            throw new \Exception('Unable to start a session');
        }
    }

    public function isLogged()
    {
        if ($this->sessionStarted) {
            return isset($_SESSION['userLogged']);
        }

        return false;
    }

    public function getLoggedUser()
    {
        if ($this->sessionStarted && isset($_SESSION['userLogged'])) {
            return  $_SESSION['userLogged'];
        }

        return null;
    }

    /**
     * Check if user exists and logs him
     * @param string $username
     * @param string $password
     *
     * @return bool
     * @throws \Exception
     */
    public function logUser($username, $password)
    {
        $user = User::getUserByUsername($username);
        $encryptedPassword = $this->encryptPassword($username, $password);

        if (! $user instanceof User || $user->getPassword() != $encryptedPassword) {
            return false;
        }

        if (!$this->sessionStarted) {
            $this->startSession();
        }

        $_SESSION['userLogged'] = $user->getId();
        return true;
    }

    public function logOut()
    {
        if (! $this->isLogged()) {
            return;
        }

        unset($_SESSION);
        session_destroy();
    }

    public function encryptPassword($username, $password)
    {
        return password_hash($password, PASSWORD_DEFAULT, ['salt' => md5($username)]);
    }
}
