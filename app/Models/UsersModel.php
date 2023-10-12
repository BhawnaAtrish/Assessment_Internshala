<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    public function getUsers($slug = false)
    {
        if ($slug === false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
    public function getAgencies()
    {
        return $this->where(['user_type' => "agency"]);
    }
    // public function getCustomers()
    // {
    //     return $this->where(['user_type' => "customer"]);
    // }
}