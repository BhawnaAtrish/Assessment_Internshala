<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\CarsModel;


class CarsController extends BaseController
{
    protected $session;
    protected $carsModel;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->carsModel = model(CarsModel::class);
    }
    public function create()
    {
        $model = model(UsersModel::class);
        // Checks whether the submitted data passed the validation rules.
        if (!$this->validate([
            'agency_id' => 'required',
            'vehicle_model' => 'required|max_length[255]|min_length[3]',
            'vehicle_number'  => 'required|max_length[5000]|min_length[1]',
            'seating_capacity' => 'required',
            'rent_per_day'  => 'required',

        ])) {
            return $this->index($message = 'Invalid data!');
        }

        $post = $this->validator->getValidated();

        $model = model(CarsModel::class);

        $model->save([
            'agency_id' => $post['agency_id'],
            'vehicle_model' => $post['vehicle_model'],
            'vehicle_number'  => $post['vehicle_number'],
            'seating_capacity' => $post['seating_capacity'],
            'rent_per_day'  => $post['rent_per_day']
        ]);
        return $this->index($message = "Car data saved successfully!");
    }

    public function index($message = false)
    {
        if ($this->session->has('user_id') && $this->session->get('user_type') == 'agency') {
            $model = model(UsersModel::class);

            $data = [
                'users'  => $model->getAgencies(),
                'title' => 'Add Car',
            ];
            if ($message) {
                $data['message'] = $message;
            }
            return view('templates/header', $data)
                . view('cars/view');
        }
        return redirect()->to("/");
    }

    public function viewBookedCars()
    {
        if ($this->session->has('user_id') && $this->session->has('user_type') && $this->session->get('user_type') == 'agency') {
            $agencyId = $this->session->get("user_id");
            $cars = $this->carsModel->getBookedCarsForAgency($agencyId);
            $data = [
                'title' => 'View Booked Cars',
                'cars' => $cars,
            ];

            return view('templates/header', $data)
                . view('cars/viewBookedCars', $data);
        }

        return redirect()->to("/");
    }

    public function viewAllCars()
    {
        if ($this->session->has('user_id') && $this->session->has('user_type') && $this->session->get('user_type') == 'agency') {
            $agencyId = $this->session->get("user_id");
            $cars = $this->carsModel->getCarsByAgency($agencyId);
            $data = [
                'title' => 'Your Cars',
                'cars' => $cars,
            ];

            return view('templates/header', $data)
                . view('cars/viewAllCars', $data);
        }

        return redirect()->to("/");
    }

    public function editCar($carId)
    {
        $car = $this->carsModel->getCarDetails($carId);

        if (!$car) {
            return redirect()->to('view_all_cars')->with('error', 'Car not found.');
        }

        $data = [
            'car' => $car,
            'title' => 'Edit Car',
        ];

        return view('templates/header', $data)
            . view('cars/edit_car');
    }

    public function updateCar($carId)
    {
        $model = model(CarsModel::class);

        // Check if the form data passes the validation rules
        if (!$this->validate([
            'vehicle_model' => 'required|max_length[255]|min_length[3]',
            'vehicle_number' => 'required|max_length[5000]|min_length[1]',
            'seating_capacity' => 'required',
            'rent_per_day' => 'required',
        ])) {
            // If validation fails, redirect back to the edit form with an error message
            return $this->editCar($carId, 'Invalid data');
        }

        // Get the validated form data
        $postData = $this->request->getPost();

        // Update the car details in the database
        $model->update($carId, $postData);

        // Redirect to the view cars page with a success message
        return redirect()->to('/view_all_cars')->with('success', 'Car details updated successfully');
    }
}
