<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\CarsModel;

use CodeIgniter\Exceptions\PageNotFoundException;

class CarsController extends BaseController
{
    public function create()
    {
        helper('form');
        $model = model(UsersModel::class);

        $data = [
            'users'  => $model->getAgencies(),
            'title' => 'Add Car',
        ];

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validate([
            'agency_id' => 'required',
            'vehicle_model' => 'required|max_length[255]|min_length[3]',
            'vehicle_number'  => 'required|max_length[5000]|min_length[1]',
            'seating_capacity' => 'required',
            'rent_per_day'  => 'required',
            
        ])) {
            // The validation fails, so returns the form.
            return $this->index();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        $model = model(CarsModel::class);

        $model->save([
            'agency_id' => $post['agency_id'],
            'vehicle_model' => $post['vehicle_model'],
            'vehicle_number'  => $post['vehicle_number'],
            'seating_capacity' => $post['seating_capacity'],
            'rent_per_day'  => $post['rent_per_day']
        ]);

        return view('templates/header', ['title' => 'Create a car item'])
            . view('cars/view', $data)
            . view('templates/footer');
    }

    public function index()
    {
        $model = model(UsersModel::class);

        $data = [
            'users'  => $model->getAgencies(),
            'title' => 'Add Car',
        ];

        helper('form');
        return view('templates/header', $data)
            . view('cars/view')
            . view('templates/footer');
    }
}