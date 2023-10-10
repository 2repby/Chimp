<?php

namespace App\Controllers;

use App\Models\UserModel;
use Framework\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = new UserModel();
        var_dump($users->all());

        return $this->view('users.php', ['users' =>  $users->all()]);

    }
    public function getById($id)
    {
        $users = new UserModel();

        var_dump($users->getById($id));
        return $this->view('user.php', ['user' => $users->getById($id)]);

    }

}