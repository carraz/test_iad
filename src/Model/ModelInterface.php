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
