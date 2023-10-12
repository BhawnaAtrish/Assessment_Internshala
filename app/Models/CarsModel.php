<?php

namespace App\Models;

use CodeIgniter\Model;

class CarsModel extends Model
{
    protected $table = 'cars';
    protected $allowedFields = ['agency_id','vehicle_model', 'vehicle_number', 'seating_capacity','rent_per_day'];
    public function getCars($slug = false)
    {
        if ($slug === false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}