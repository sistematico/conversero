<?php

namespace App\Controller;
use App\Model\User;

class UsersController
{
    public function add()
    {
        $User = new User();
        echo $User->add($_POST["usuario"], $_POST["senha"]);
    }

    public function login()
    {
        $User = new User();
        echo $User->login($_POST["usuario"], $_POST["senha"]);
    }

    public function logout()
    {
        $User = new User();
        echo $User->logout();
    }

    public function logged()
    {
        $User = new User();
        echo $User->logged();
    }
}
