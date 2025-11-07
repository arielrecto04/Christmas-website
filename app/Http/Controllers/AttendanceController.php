<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::with(['attendance'])->get();


        return view('attendance', compact('users'));
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

        $user = json_decode($request->selected_user);


        if(!$user){
            return back()->with(['error' => 'Select your name first!']);   
        }


        if($user->attendance){

            return back()->with(['error' => 'You have attendance already']);
        }

    

        $cleanedDateString = preg_replace('/\(.*?\)/', '', $request->arrival_date);


        Attendance::create([
            'arrival_date' => Carbon::parse($cleanedDateString),
            'user_id' => $user->id
        ]);


        return to_route('attendance.congrats', ['user' => $user->slug]);
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

        $attendance->delete();


        return back()->with(['message' => 'Attendance Deleted']);
    }

    public function congrats(string $name)
    {

        $user = User::where('slug', $name)->first();

        if (!$user->attendance) {
            return to_route('attendance.index');
        }

        return view('congrats', compact('user'));
    }
}
