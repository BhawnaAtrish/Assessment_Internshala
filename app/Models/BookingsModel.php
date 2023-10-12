<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingsModel extends Model
{
    protected $table = 'bookings';
    public function getBookings($slug = false)
    {
        if ($slug === false) {
            return $this->findAll();
        }

        return $this->where(['booking_id' => $slug])->first();
    }
}