<?php

namespace Controller;

use Helper\Template;

class LoginController extends BaseController
{
    const LOGIN_TEMPLATE_PATH = __DIR__ . '/../View/login.html.php';

    public function login()
    {
        $template = new Template(self::LOGIN_TEMPLATE_PATH, ['test' => '<div>']);
        return $template->display();
    }
}
