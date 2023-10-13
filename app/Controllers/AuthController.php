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
    public function checkIfUserisLoggedIn()
    {
        return ($this->session->has('user_id') && $this->session->has('user_type'));
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
            $session->set('fullname', $user['fullname']);
            if ($user["user_type"] == "agency")
                return redirect()->to('view_all_cars/');
            else
                return redirect()->to('/about');
        } else {
            return $this->index($message = 'Invalid credentials');
        }
    }

    public function index($message = false)
    {
        $isUserLoggedIn = $this->checkIfUserisLoggedIn();
        if ($isUserLoggedIn) {
            return redirect()->to('/view_available_cars');
        }
        $data = [
            'title' => 'Login Here'
        ];
        if (isset($message) && $message) {
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

    public function register($data = false)
    {
        if (!isset($data)) {
            $data = [];
        }
        $data['title'] = 'Registration Page';
        return view('templates/header', $data)
            . view('accounts/registrationForm', $data);
    }

    public function createCustomer()
    {
        $userModel = model(UsersModel::class);

        $username = $this->request->getPost('customerUsername');
        $password = $this->request->getPost('customerPassword');
        $fullname = $this->request->getPost('customerFullName');

        if (empty($username) || empty($password)) {
            return $this->register(['error' => 'Username and password must not be empty']);
        }

        if ($userModel->createUser($username, $password, 'customer', $fullname)) {
            return redirect()->to('/');
        } else {
            return $this->register(['error' => 'Username is already taken']);
        }
    }

    public function createAgency()
    {
        $userModel = model(UsersModel::class);

        $username = $this->request->getPost('agencyUsername');
        $password = $this->request->getPost('agencyPassword');
        $fullname = $this->request->getPost('agencyFullName');

        if (empty($username) || empty($password)) {
            return $this->register(['error' => 'Username and password must not be empty']);
        }

        if ($userModel->createUser($username, $password, 'agency', $fullname)) {
            return redirect()->to('/');
        } else {
            return $this->register(['error' => 'Username is already taken']);
        }
    }
}
