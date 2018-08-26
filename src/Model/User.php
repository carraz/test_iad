<?php

namespace Model;

use Helper\Database;

class User extends AbstractModel
{
    /**
     * @var string
     */
    protected $login;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $plainPassword;

    /**
     * @var string
     */
    protected $passwordRepeat;

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
     * @return string
     */
    public function getPasswordRepeat()
    {
        return $this->passwordRepeat;
    }

    /**
     * @param string $passwordRepeat
     *
     * @return User
     */
    public function setPasswordRepeat($passwordRepeat)
    {
        $this->passwordRepeat = $passwordRepeat;

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

    /**
     * @return bool
     */
    public function validate()
    {
        if (! is_null($this->plainPassword) && $this->plainPassword != $this->passwordRepeat) {
            $this->errorValidation[] = 'Les mots de passe ne correspondent pas';
        }

        if (! is_null($this->plainPassword) &&
            ! (
                preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/', $this->plainPassword) &&
                strlen($this->plainPassword) >= 8 && strlen($this->plainPassword) <= 16)
        ) {
            $this->errorValidation[] =
                'Le mot de passe doit être entre 8 et 16 caractères, contenir une majuscule et un chiffre';
        }

        if (empty($this->login)) {
            $this->errorValidation[] = 'Veuillez renseigner un identifiant';
        }

        if (strlen($this->login) > 150) {
            $this->errorValidation[] = 'L\'identifiant est trop long';
        }

        if (! $this->checkUniqueUserLogin()) {
            $this->errorValidation[] = 'Cet identifiant est déjà utilisé';
        }

        if (empty($this->id) && empty($this->plainPassword)) {
            $this->errorValidation[] = 'Veuillez renseigner un mot de passe';
        }
        return parent::validate();
    }

    /**
     * @return $this|AbstractModel
     * @throws \Exception
     */
    public function save()
    {
        $params = [
            ':login' => $this->login,
            ':password' => $this->password,
        ];

        if (empty($this->id)) {
            $sql = 'INSERT INTO users (login, password) VALUES (:login, :password)';
        } else {
            $sql = 'UPDATE users set login = :login, password = :password WHERE id = :id';
            $params[':id'] = $this->id;
        }
        $this->saveModel($sql, $params);

        $this->plainPassword = null;
        $this->passwordRepeat = null;

        return $this;
    }

    private function checkUniqueUserLogin()
    {
        if (empty($this->login)) {
            return true;
        }
        $userSql = 'SELECT COUNT(id) as nbUser FROM users WHERE login = :login';
        $db = Database::getInstance();
        $params = [':login' => $this->login];

        if (!empty($this->id)) {
            $userSql .= ' AND id <> :id';
            $params[':id'] = $this->id;
        }

        $statement = $db->prepare($userSql);
        if (! $statement->execute($params) || ! $result = $statement->fetch(\PDO::FETCH_ASSOC)) {
            throw new \Exception('Unable to check unique user login');
        }

        return $result['nbUser'] == 0;
    }
}
