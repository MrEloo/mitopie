<?php

class UserController extends AbstractController
{
    public function updateNewsletter(): void
    {
        $um = new UserManager();
        $um->updateNewsletter($_GET['bool'], $_SESSION['user_id']);

        $this->redirect('index.php?route=profil');
    }
}
