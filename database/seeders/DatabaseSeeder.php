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
            ["id_number" => "023", "email" => "ronanmanzanares@gardenia.com.ph"],
            ["id_number" => "034", "email" => "montanoplata@gardenia.com.ph"],
            ["id_number" => "038", "email" => "anthonygaringalao@gardenia.com.ph"],
            ["id_number" => "050", "email" => "danperez@gardenia.com.ph"],
            ["id_number" => "065", "email" => "andiehofstetter@gardenia.com.ph"],
            ["id_number" => "079", "email" => "jaypantallano@gardenia.com.ph"],
            ["id_number" => "080", "email" => "jankarlbrao@gardenia.com.ph"],
            ["id_number" => "086", "email" => "anjie.boton@innovatotec.com"],
            ["id_number" => "088", "email" => "dave.giron@innovatotec.com"],
            ["id_number" => "093", "email" => "alferdavealviz@gardenia.com.ph"],
            ["id_number" => "099", "email" => "josephgalisim@gardenia.com.ph"],
            ["id_number" => "103", "email" => "johnemersonbanares@gardenia.com.ph"],
            ["id_number" => "105", "email" => "henryganal@gardenia.com.ph"],
            ["id_number" => "106", "email" => "geraldpaulruga@gardenia.com.ph"],
            ["id_number" => "107", "email" => "ariescastro@gardenia.com.ph"],
            ["id_number" => "108", "email" => "djboysupsup@gardenia.com.ph"],
            ["id_number" => "109", "email" => "mj.restrivera@innovatotec.com"],
            ["id_number" => "110", "email" => "vincentanthonybajenting@gardenia.com.ph"],
            ["id_number" => "111", "email" => "ariel.recto@innovatotec.com"],
            ["id_number" => "112", "email" => "harroldrebana@gardenia.com.ph"],
            ["id_number" => "003", "email" => "tricia.depante@innovatotec.com"],
            ["id_number" => "119", "email" => "steven.vicente@innovatotec.com"],
            ["id_number" => "113", "email" => "ralphjosephsebastian@gardenia.com.ph"],
            ["id_number" => "114", "email" => "joshualorenzocontante@gardenia.com.ph"],
            ["id_number" => "115", "email" => "jhaymee.magnawa@innovatotec.com"],
            ["id_number" => "116", "email" => "ryanjayantiquerra@gardenia.com.ph"],
            ["id_number" => "117", "email" => "ryan.marte@innovatotec.com"],
            ["id_number" => "118", "email" => "albertpunzalan@gardenia.com.ph"],
            ["id_number" => "120", "email" => "johndenborja@gardenia.com.ph"],
            ["id_number" => "121", "email" => "nelsonpalada@gardenia.com.ph"],
            ["id_number" => "122", "email" => "rold.jamisola@innovatotec.com"],
            ["id_number" => "123", "email" => "fraziermhonperez@gardenia.com.ph"],
            ["id_number" => "124", "email" => "vash.ancheta@innovatotec.com"],
            ['id_number' => 'password', 'email' => 'alethea.teope@gmail.com'],
            ['id_number' => 'password', 'email' => 'cpinero522003@gmail.com'],
            ['id_number' => '125', 'email' => 'marvin.estremadura@innovatotec.com']
        ];


        $employeeUsers = collect($employees)->map(function ($employeeName) {

            $username = explode('@', $employeeName['email'])[0];


            $cleaned_name = str_replace('.', '', $username);


            $user = User::create([
                'name' => $cleaned_name,
                'email' => $employeeName['email'],
                'password' => Hash::make($employeeName['id_number']),
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
