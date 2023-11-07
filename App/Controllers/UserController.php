<?php

namespace App\Controllers;

use App\Models\UserModel;
use Framework\Controller;
use Framework\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = Request::getUser();
        $users = new UserModel();
        return $this->view('users.php', ['users' =>  $users->all()]);

    }
    public function getById($id)
    {
        $users = new UserModel();
        return $this->view('user.php', $users->getById($id));

    }

}