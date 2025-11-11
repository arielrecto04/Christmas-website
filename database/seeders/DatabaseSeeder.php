<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\CandidateVote;
use App\Models\User;
use App\Models\Role;
use App\Models\Survey;
use App\Models\SurveyCandidate;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Roles
        $roles = ['admin', 'employee'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Admin user
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
        ]);
        $admin->ticket()->create(['ticket_number' => Ticket::generateTicketNumber()]);
        $admin->roles()->attach(Role::where('name', 'admin')->first()->id);

        // Employee user (example)
        $employee = User::create([
            'name' => 'employee',
            'email' => 'employee@employee.com',
            'password' => Hash::make('employee123'),
        ]);
        $employee->ticket()->create(['ticket_number' => Ticket::generateTicketNumber()]);
        $employee->roles()->attach(Role::where('name', 'employee')->first()->id);

        // Employees array
        $employees = [
            'Jhaymee Magnawa',
            'Angeline Boton',
            'Dave Giron',
            'Ariel Recto',
            'Steven Vicente',
            'Ryan Marte',
            'Harold Jamisola',
            'Vash Ulric Ancheta',
            'Alethea Teope',
            'Cesar Piñero',
            'Shen Angeles',
            'Ronan Manzanares',
            'Alfer Alviz',
            'Ryan Antiquerra',
            'Vincent Bajenting',
            'John Bañares',
            'Karl Brao',
            'Renzo Contante',
            'Henry Ganal',
            'Harrold Rebana',
            'DJ Supsup',
            'Mhon Perez',
            'Aries Castro',
            'Albert Punzalan',
            'John Den Borja',
            'Anthony Garingalao',
            'Jay Patallano',
            'Andie Hofstetter',
            "M'PHD - Patricia H. Depante",
            "M'RHD1 - Renee H. Depante",
            "M'RHD2 - Regina H. Depante",
        ];

        $employeeUsers = collect($employees)->map(function ($employeeName) {
            $user = User::create([
                'name' => $employeeName,
                'email' => Str::slug($employeeName) . '@gmail.com',
                'password' => Hash::make('password'),
            ]);

            $user->roles()->attach(Role::where('name', 'employee')->first()->id);
            $user->ticket()->create(['ticket_number' => Ticket::generateTicketNumber()]);
            $user->attendance()->create(['arrival_date' => Carbon::now()]);

            return $user; // collect all created users
        });

        // Create Survey
        $survey = Survey::create([
            'name' => 'Best Outfit',
            'year' => Carbon::now()->year,
        ]);

        // Add admin as candidate
        $candidateAdmin = $survey->candidates()->create([
            'user_id' => $admin->id,
        ]);

        // Add all employee users as candidates
        $employeeUsers->each(function ($user) use ($survey) {
            $survey->candidates()->create(['user_id' => $user->id]);
        });

        // Give one example vote from first employee
        if ($employeeUsers->isNotEmpty()) {
            $employeeUsers->first()->votes()->create([
                'survey_candidate_id' => $candidateAdmin->id,
            ]);
        }
    }
}
