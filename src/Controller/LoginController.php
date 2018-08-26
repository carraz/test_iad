<?php

namespace Controller;

use Helper\Template;

class LoginController extends BaseController
{
    const LOGIN_TEMPLATE_PATH = __DIR__ . '/../View/login.html.php';

    public function login()
    {
        if ($this->security->isLogged()) {
            $this->redirect('?controller=MainController&action=main');
        }

        $templateVars = [
            'errorMessage' => false
        ];

        if ($this->request->getMethod() == 'POST') {
            $post = $this->request->getAllPostData();
            $templateVars['errorMessage'] = 'Merci d\'entrer un identifiant et un mot de passe';

            if (!empty($post['login']) && !empty($post['password'])) {
                $isLogged = $this->security->logUser($post['login'], $post['password']);

                if ($isLogged) {
                    $this->redirect('?controller=MainController&action=main');
                }
                $templateVars['errorMessage'] = 'L\'identifiant ou le mot de passe est incorrect';
            }
        }

        $template = new Template(self::LOGIN_TEMPLATE_PATH, $templateVars);
        return $template->display();
    }

    public function logout()
    {
        $this->security->logOut();
        $this->redirect('?controller=LoginController&action=login');
    }
}
