<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $employees = Employee::get();


        return view('attendance', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $employee = json_decode($request->selected_employee);


        $cleanedDateString = preg_replace('/\(.*?\)/', '', $request->arrival_date);


        Attendance::create([
            'arrival_date' => Carbon::parse($cleanedDateString),
            'employee_id' => $employee->id
        ]);


        return to_route('attendance.congrats', ['employee' => $employee->slug]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function congrats(string $name)
    {

        $employee = Employee::where('slug', $name)->first();

        if (!$employee->attendance) {
            return to_route('attendance.index');
        }

        return view('congrats', compact('employee'));
    }
}
