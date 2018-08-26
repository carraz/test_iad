<?php
namespace Model;

use Helper\Database;

abstract class AbstractModel implements ModelInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * AbstractModel constructor.
     *
     * @param array $data
     *
     * @throws \Exception
     */
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (! property_exists($this, $key)) {
                throw new \Exception('Property ' . addslashes($key) . ' does not exist in class ' . get_class($this));
            }
            $this->$key = $value;
        }
    }

    /**
     * @param string $sql
     * @param array  $criteria
     * @param bool   $oneResult
     *
     * @return array|bool|AbstractModel
     * @throws \Exception
     */
    protected static function getModelResult($sql, array $criteria = [], $oneResult = false)
    {
        $db = Database::getInstance();

        $statement = $db->prepare($sql);

        foreach ($criteria as $key => $value) {
            $statement->bindParam(':' . $key, $value);
        }

        if (! $statement->execute()) {
            throw new \Exception('Unable to perform request "' . $sql . '""');
        }

        if ($oneResult) {
            $result = $statement->fetch(\PDO::FETCH_ASSOC);

            if (!$result) {
                return false;
            }
            return new static($result);
        }

        $models = [];
        $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($results as $row) {
            $models = new static($row);
        }

        return $models;
    }

    /**
     * Returns a list of models
     *
     * @return AbstractModel[]
     */
    public static function getAll()
    {
        return static::getModelResult(static::getAllSql());
    }

    /**
     * Returns one model by its id
     *
     * @param int $id
     *
     * @return AbstractModel
     */
    public static function getOneById($id)
    {
        return static::getModelResult(static::getOneSql(), ['id' => $id], true);
    }
}
