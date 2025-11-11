<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::with(['attendance'])->get();


        return view('attendance2', compact('users'));
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
    public function store()
    {
        $user = auth()->user();

        if ($user->attendance) {
            return back()->with('error', 'You have already submitted your attendance.');
        }

        $user->attendance()->create([
            'arrival_date' => Carbon::now(),
        ]);

        return redirect()->route('christmas.attendance')->with('message', 'Attendance successfully worked');
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
        $attendance = Attendance::find($id);

        if (!$attendance) {
            return back()->with(['error' => 'Attendance not found.']);
        }

        $attendance->delete();

        return back()->with(['message' => 'Attendance Deleted']);
    }

    public function congrats(string $name)
    {
        $user = User::all()->firstWhere(fn($u) => Str::slug($u->name) === $name);

        if (!$user || !$user->attendance) {
            return to_route('attendance.index');
        }

        return view('congrats', compact('user'));
    }
}
