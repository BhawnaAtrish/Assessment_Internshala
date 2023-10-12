<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\CarsModel;


class CarsController extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
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
}
