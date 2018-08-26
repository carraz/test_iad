<?php

require_once '../var/autoloader.php';

try {
    //Secure request data
    $request = new \Helper\Request($_GET, $_POST);

    //route to the good controller and display data
    $router  = new \Helper\Router($request);
    echo $router->route();
} catch (\Exception\NotFoundException $notFoundException) {
    header("HTTP/1.0 404 Not Found");
} catch (Exception $e) {
    echo $e->getMessage();
}
