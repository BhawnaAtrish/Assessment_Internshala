<?php

namespace App\Models;

use CodeIgniter\Model;

class CarsModel extends Model
{
    protected $table = 'cars';
    protected $allowedFields = [
        'agency_id',
        'vehicle_model',
        'vehicle_number',
        'seating_capacity',
        'rent_per_day',
    ];
    protected $primaryKey = 'car_id';


    public function getAllCars()
    {
        return $this->findAll();
    }

    public function getCarsByAgency($agency_id)
    {
        $db = db_connect();
        $query = $db->query("SELECT * FROM cars WHERE agency_id = $agency_id");
        $carsByAgency =  $query->getResult();
        return $carsByAgency;
    }

    public function getBookedCarsForAgency($agency_id)
    {
        $db = db_connect();
        $query = $db->query(
            "SELECT t2.*, t1.customer_id, t1.booking_date FROM bookings t1
             INNER JOIN cars t2 ON t1.car_id = t2.car_id
             WHERE t2.agency_id = $agency_id AND DATE_ADD(t1.start_date, INTERVAL t1.number_of_days DAY) >= CURDATE()"
        );

        $bookedCars = $query->getResult();
        return $bookedCars;
    }

    public function getCarDetails($carId)
    {
        $car = $this->where(['car_id' => $carId])->first();
        return $car;
    }
}
