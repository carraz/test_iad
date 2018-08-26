<?php

namespace Controller;

use Helper\Request;

/**
 * Class BaseController
 *
 * @package Controller
 */
abstract class BaseController
{
    /**
     * @var Request
     */
    private $request;

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }
}
