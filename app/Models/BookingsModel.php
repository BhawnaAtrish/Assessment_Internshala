<?php

namespace App\Models;

use App\Controllers\CarsController;
use CodeIgniter\Model;
use App\Models\CarsModel;
use App\Models\UsersModel;

class BookingsModel extends Model
{
    protected $table = 'bookings';
    protected $allowedFields = [
        'booking_id',
        'car_id',
        'customer_id ',
        'booking_date',
        'start_date',
        'number_of_days'
    ];
    protected $carsModel;
    protected $usersModel;


    public function __construct()
    {
        $this->carsModel = new CarsModel();
        $this->usersModel = new UsersModel();
    }

    public function createBooking($carId, $customerId, $startDate, $numberOfDays)
    {
        $carExists = $this->carsModel->find($carId);
        $customerExists = $this->usersModel->find($customerId);

        if ($carExists && $customerExists) {
            $db = db_connect();
            $sql = 'INSERT INTO bookings (car_id, customer_id, start_date, number_of_days) 
                VALUES (?, ?, ?, ?)';

            $result = $db->query($sql, [$carId, $customerId, $startDate, $numberOfDays]);

            return $result ? true : false;
        } else {
            return false;
        }
    }
}
