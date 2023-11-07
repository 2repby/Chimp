<?php

namespace Framework;

use App\Models\UserModel;

class Auth
{
    public function enrichByUser(Request $request): Request
    {
        if ($session = $request->getSession()) {
            $userModel = new UserModel;
            $request->setUser($userModel->getById((int)$session['id']));
        }
        return $request;
    }
}