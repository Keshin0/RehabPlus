<?php

namespace App\Controllers;

class Appointments extends BaseController
{
    public function index()
    {
        $appointments = [
            [
                'patient' => 'Juan dela Cruz',
                'therapist' => 'Dr. Santos',
                'date' => 'May 20, 2026',
                'time' => '9:00 AM',
                'status' => 'Upcoming'
            ],
            [
                'patient' => 'Maria Santos',
                'therapist' => 'Dr. Reyes',
                'date' => 'May 21, 2026',
                'time' => '1:00 PM',
                'status' => 'Completed'
            ],
            [
                'patient' => 'Pedro Reyes',
                'therapist' => 'Dr. Cruz',
                'date' => 'May 22, 2026',
                'time' => '3:00 PM',
                'status' => 'Cancelled'
            ]
        ];

        return view('appointments/index', [
            'appointments' => $appointments
        ]);
    }

    public function create()
    {
        return view('appointments/create');
    }

    public function store()
    {
        return redirect()->to('/appointments')
            ->with('success', 'Appointment scheduled successfully.');
    }
}