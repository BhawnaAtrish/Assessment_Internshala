<?php

namespace App\Controllers;

use App\Models\UsersModel;

class AuthController extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
    }
    public function authenticate()
    {
        $userModel = model(UsersModel::class);

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->getUser($username, $password);

        if ($user) {
            $session = session();
            $session->set('user_id', $user['user_id']);
            $session->set('username', $user['username']);
            $session->set('user_type', $user['user_type']);

            return redirect()->to('add_cars/');
        } else {
            return $this->index($message = 'Invalid credentials');
        }
    }

    public function index($message = false)
    {
        $data = [
            'title' => 'Login Here'
        ];
        if (isset($message)) {
            $data['message'] = $message;
        }
        return view('templates/header', $data)
            . view('accounts/loginForm');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/');
    }
}
