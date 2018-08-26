<?php

namespace Controller;

use Helper\Request;
use Helper\Security;

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
    protected $request;

    /**
     * @var Security
     */
    protected $security;

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    public function setSecurity(Security $security)
    {
        $this->security = $security;
    }

    protected function redirect($url)
    {
        header('Location: ' . $url);
    }
}
