<?php

namespace Controller;

use Helper\Template;

class MainController extends BaseController
{
    const MAIN_TEMPLATE_PATH = __DIR__ . '/../View/main.html.php';

    public function main()
    {
        if (! $this->security->isLogged()) {
            $this->redirect('?controller=LoginController&action=login');
        }

        $template = new Template(self::MAIN_TEMPLATE_PATH);
        return $template->display();
    }
}
