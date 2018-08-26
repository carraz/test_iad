<?php

namespace Controller;

use Helper\Template;
use Model\User;

class AccountController extends BaseController
{
    const CREATE_ACCOUNT_TEMPLATE_PATH = __DIR__ . '/../View/account_creation.html.php';

    public function createAccount()
    {
        if ($this->security->isLogged()) {
            $this->redirect('?controller=MainController&action=main');
        }
        $errors = [];

        if ($this->request->getMethod() == 'POST') {
            $post = $this->request->getAllPostData();

            $user = new User($post);

            if ($user->validate()) {
                $user->setPassword($this->security->encryptPassword($user->getLogin(), $user->getPlainPassword()));
                $user->save();

                $this->redirect('?controller=LoginController&action=login');
            }

            $errors = $user->getErrorValidation();
        }


        $template = new Template(self::CREATE_ACCOUNT_TEMPLATE_PATH, ['errors' => $errors]);
        return $template->display();
    }
}
