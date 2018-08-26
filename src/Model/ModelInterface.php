<?php

namespace Model;

interface ModelInterface
{
    /**
     * ModelInterface constructor.
     *
     * @param array $data
     */
    public function __construct(array $data);

    /**
     * Saves the current model in database
     * @return AbstractModel
     */
    public function save();

    /**
     * Validate fields of model
     * @return bool
     */
    public function validate();

    /**
     * Returns SQL request for all results
     * @return string
     */
    public static function getAllSql();

    /**
     * Returns SQL request for one result
     * @return string
     */
    public static function getOneSql();
}
