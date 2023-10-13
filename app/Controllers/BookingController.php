<?php

namespace App\Controllers;

use App\Models\BookingsModel;

class BookingController extends BaseController
{

    protected $session;
    protected $bookingModel;
    protected $authController;
    protected $carsController;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->bookingModel = model(BookingsModel::class);
        $this->authController = new AuthController();
        $this->carsController = new CarsController();
    }

    public function rentCar()
    {
        if (!$this->authController->checkIfUserisLoggedIn()) {
            return redirect()->to('/');
        } else if ($this->session->has('user_type') && $this->session->get('user_type') == 'agency') {
            return redirect()->to('/view_all_cars');
        }

        $carId = $this->request->getPost('car-id');
        $days = $this->request->getPost('days');
        $startDate = $this->request->getPost('start-date');
        $customerId = $this->session->get("user_id");

        $result = $this->bookingModel->createBooking($carId, $customerId, $startDate, $days);

        $data = ["message" => ""];
        if ($result) {
            $data["message"] = 'Car Booked Successfully!';
        }
        else{
            $data["message"] = 'Unable to Book Car';
        }
        return $this->carsController->availableCars($data);
    }
}
