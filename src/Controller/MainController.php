<?php

namespace Controller;

use Helper\Template;
use Model\Message;
use Model\User;

class MainController extends BaseController
{
    const MAIN_TEMPLATE_PATH = __DIR__ . '/../View/main.html.php';

    public function main()
    {
        if (! $this->security->isLogged()) {
            $this->redirect('?controller=LoginController&action=login');
        }

        $errors = [];

        /** @var User $connectedUser */
        $connectedUser = User::getOneById($this->security->getLoggedUser());

        if ($this->request->getMethod() == 'POST') {
            $post = $this->request->getAllPostData();
            $message = new Message($post);
            if ($message->validate()) {
                $message->setUser($connectedUser);
                $message->setCreatedAt(new \DateTime());
                $message->save();

                $this->redirect('?controller=MainController&action=main');
            }

            $errors = $message->getErrorValidation();
        }

        $messages = Message::getAll();

        $template = new Template(
            self::MAIN_TEMPLATE_PATH,
            ['messages' => $messages, 'errors' => $errors, 'connectedUser' => $connectedUser->getLogin()]
        );
        return $template->display();
    }
}
