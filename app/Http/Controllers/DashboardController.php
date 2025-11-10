<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $attendances = Attendance::with(['user.ticket'])
            ->orderBy('arrival_date', 'asc')
            ->paginate(10);

        $totalAttendees = Attendance::count();

        $totalUsers = User::count();


        $attendanceDataSet = [
            'present' => User::whereHas('attendance')->count(),
            'absent' => User::whereDoesntHave('attendance')->count()
        ];

      

        return view('dashboard', compact('attendances', 'totalAttendees', 'totalUsers', 'attendanceDataSet'));
    }
}
