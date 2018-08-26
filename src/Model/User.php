<?php

namespace Model;

class User extends AbstractModel
{
    protected $login;

    protected $password;

    protected $plainPassword;

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     *
     * @return User
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     *
     * @return User
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * @param $username
     *
     * @return array|AbstractModel
     * @throws \Exception
     */
    public static function getUserByUsername($username)
    {
        $sql = 'SELECT * FROM users WHERE login = :login';
        return static::getModelResult($sql, ['login' => $username], true);
    }

    /**
     * Returns SQL request for all results
     *
     * @return string
     */
    public static function getAllSql()
    {
        return 'SELECT * FROM users;';
    }

    /**
     * Returns SQL request for one result
     *
     * @return string
     */
    public static function getOneSql()
    {
        return 'SELECT * FROM users WHERE id = :id';
    }
}
