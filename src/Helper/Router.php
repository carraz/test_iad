<?php

namespace Helper;

use Controller\BaseController;
use Exception\ClassNotFoundException;
use Exception\NotFoundException;

class Router
{
    const CONTROLLER_PARAM = 'controller';
    const ACTION_PARAM     = 'action';
    const CONTROLLER_NAMESPACE = '\\Controller\\';

    /**
     * @var Request
     */
    private $request;

    /**
     * Router constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Manage the controller to call switch the routing params
     * @return string
     * @throws NotFoundException
     */
    public function route()
    {
        $controllerName = $this->request->getQuery(self::CONTROLLER_PARAM);
        $action         = $this->request->getQuery(self::ACTION_PARAM);
        if (is_null($controllerName) || is_null($action)) {
            throw new NotFoundException('Controller or action not specified');
        }

        $controllerFullName = self::CONTROLLER_NAMESPACE . $controllerName;

        try {
            $controller = new $controllerFullName();
            if ($controller instanceof BaseController) {
                $controller->setRequest($this->request);
            }

            if (! method_exists($controller, $action)) {
                throw new NotFoundException('Action ' . addslashes($action) . ' does not exist');
            }

            $security = new Security();
            $security->startSession();
            $controller->setSecurity($security);

            return $controller->$action();
        } catch (ClassNotFoundException $e) {
            throw new NotFoundException($e->getMessage());
        }
    }
}
