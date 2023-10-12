<?php

namespace App\Controllers;

use App\Models\BookingsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Bookings extends BaseController
{
    public function index()
    {
        $model = model(BookingsModel::class);

        $data = [
            'bookings'  => $model->getBookings(),
            'title' => 'Car Booking',
        ];

        return view('templates/header', $data)
            . view('bookings/index')
            . view('templates/footer');
    }

    public function show($slug = null)
    {
        $model = model(BookingsModel::class);

        $data['bookings'] = $model->getBookings($slug);

        if (empty($data['bookings'])) {
            throw new PageNotFoundException('Cannot find the booking item: ' . $slug);
        }

        $data['title'] = $data['bookings']['booking_id'];

        return view('templates/header', $data)
            . view('bookings/view')
            . view('templates/footer');
    }
}