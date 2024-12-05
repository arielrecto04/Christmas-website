<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $employeeAttendances = Employee::join('attendances', 'employees.id', '=', 'attendances.employee_id')
            ->orderBy('attendances.arrival_date', 'asc')
            ->select('employees.*')
            ->paginate(10);

        $totalAttendees = Attendance::count();

        $totalEmployees = Employee::count();


        $attendanceDataSet = [
            'present' => Employee::whereHas('attendance')->count(),
            'absent' => Employee::whereDoesntHave('attendance')->count()
        ];

      

        return view('dashboard', compact('employeeAttendances', 'totalAttendees', 'totalEmployees', 'attendanceDataSet'));
    }
}
