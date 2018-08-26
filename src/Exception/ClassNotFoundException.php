<?php

namespace Exception;

/**
 * Class ClassNotFoundException
 *
 * @package Exception
 */
class ClassNotFoundException extends \Exception
{
    public function __construct($className)
    {
        parent::__construct('Class ' . addslashes($className) . ' not found');
    }
}
