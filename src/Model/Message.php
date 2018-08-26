<?php

namespace Model;

class Message extends AbstractModel
{
    /**
     * @var string
     */
    protected $message;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var User
     */
    protected $user;
    /**
     * @var int
     */
    protected $userId;

    public function __construct(array $data)
    {
        parent::__construct($data);

        if (!is_null($this->userId)) {
            $this->user = User::getOneById($this->userId);
        }

        if (!is_null($this->createdAt)) {
            $this->createdAt = new \DateTime($this->createdAt);
        }
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return Message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return Message
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return Message
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        $this->userId = $user->getId();

        return $this;
    }

    public function validate()
    {
        if (empty($this->message)) {
            $this->errorValidation[] = 'Veuillez saisir un message';
        }

        if (strlen($this->message) > 255) {
            $this->errorValidation[] = 'Le message est trop long';
        }

        return parent::validate();
    }

    /**
     * Saves the current model in database
     *
     * @return AbstractModel
     */
    public function save()
    {
        if (empty($this->userId) || ! $this->createdAt instanceof \DateTime) {
            throw new \Exception('Message cannot be saved, parameters missing');
        }

        $params = [
            ':message'   => $this->message,
            ':createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
            ':userId'    => $this->userId
        ];

        if (empty($this->id)) {
            $sql = 'INSERT INTO messages (message, createdAt, userId) VALUES (:message, :createdAt, :userId)';
        } else {
            $sql = 'UPDATE messages set message = :message, createdAt = :createdAt, userId = :userId WHERE id = :id';
            $params[':id'] = $this->id;
        }
        $this->saveModel($sql, $params);
        return $this;
    }

    /**
     * Returns SQL request for all results
     *
     * @return string
     */
    public static function getAllSql()
    {
        return 'SELECT * FROM messages ORDER BY createdAt ASC';
    }

    /**
     * Returns SQL request for one result
     *
     * @return string
     */
    public static function getOneSql()
    {
        return 'SELECT * FROM messages where id = :id';
    }
}
