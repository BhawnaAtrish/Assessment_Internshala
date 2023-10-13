<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = [
        'user_id',
        'username',
        'password',
        'user_type',
        'fullname'
    ];
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

    public function isUsernameTaken($username)
    {
        return $this->where(['username' => $username])->countAllResults() > 0;
    }

    public function createUser($username, $password, $userType, $fullname)
    {
        // Check if the username is already taken
        if ($this->isUsernameTaken($username)) {
            return false; // Username is already taken
        }

        // Insert the new user into the database
        $data = [
            'username' => $username,
            'password' => $password,
            'user_type' => $userType,
            'fullname' => $fullname
        ];

        $this->insert($data);

        return true; // Registration successful
    }
}
