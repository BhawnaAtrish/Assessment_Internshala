<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    public function getUsers()
    {
        return $this->findAll();
    }
    public function getAgencies()
    {
        return $this->where(['user_type' => "agency"]);
    }
    public function getUser($username, $password)
    {
        $user = $this->where(['username' => $username, 'password' => $password])->first();
        if ($user) {
            return $user;
        } else {
            return null;
        }
    }
}
