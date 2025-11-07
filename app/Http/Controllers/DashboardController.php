<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $userAttendances = User::join('attendances', 'users.id', '=', 'attendances.user_id')
            ->orderBy('attendances.arrival_date', 'asc')
            ->select('users.*')
            ->paginate(10);

        $totalAttendees = Attendance::count();

        $totalUsers = User::count();


        $attendanceDataSet = [
            'present' => User::whereHas('attendance')->count(),
            'absent' => User::whereDoesntHave('attendance')->count()
        ];

      

        return view('dashboard', compact('userAttendances', 'totalAttendees', 'totalUsers', 'attendanceDataSet'));
    }
}
