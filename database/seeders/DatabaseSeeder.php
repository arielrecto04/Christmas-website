<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\CandidateVote;
use App\Models\User;
use App\Models\Employee;
use App\Models\Role;
use App\Models\Survey;
use App\Models\SurveyCandidate;
use App\Models\Ticket;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // User::factory(10)->create();

        $roles = [
            'admin',
            'employee',
        ];

        foreach($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        $employee = User::create([
            'name' => 'employee',
            'email' => 'employee@employee.com',
            'password' => Hash::make('employee123')
        ]);

        $employee->ticket()->create([
            'ticket_number' => Ticket::generateTicketNumber()
        ]);
        $employee->roles()->attach(Role::where('name', 'employee')->first()->id);
        $employee->attendance()->create([
            'arrival_date' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123')
        ]);
                
        $admin->ticket()->create([
            'ticket_number' => Ticket::generateTicketNumber()
        ]);

        $admin->roles()->attach(Role::where('name', 'admin')->first()->id);

        $admin->attendance()->create([
            'arrival_date' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
        $employees = [
            'Jhaymee Magnawa',
            'Angeline Boton',
            // 'Dave Giron',
            // 'Ariel Recto',
            // 'Steven Vicente',
            // 'Ryan Marte',
            // 'Harold Jamisola',
            // 'Vash Ulric Ancheta',
            // 'Alethea Teope',
            // 'Cesar Piñero',
            // 'Shen Angeles',
            // 'Ronan Manzanares',
            // 'Alfer Alviz',
            // 'Ryan Antiquerra',
            // 'Vincent Bajenting',
            // 'John Bañares',
            // 'Karl Brao',
            // 'Renzo Contante',
            // 'Henry Ganal',
            // 'Harrold Rebana',
            // 'DJ Supsup',
            // 'Mhon Perez',
            // 'Aries Castro',
            // 'Albert Punzalan',
            // 'John Den Borja',
            // 'Anthony Garingalao',
            // 'Jay Patallano',
            // 'Andie Hofstetter',
            // "M'PHD - Patricia H. Depante",
            // "M'RHD1 - Renee H. Depante",
            // "M'RHD2 - Regina H. Depante",
        ];

        collect($employees)->map(function($employee){
            $user = User::create([
                'name' => $employee,
                'email' => Str::slug($employee) . '@gmail.com',
                'password' => Hash::make('password'),
            ]);

            $user->roles()->attach(Role::where('name', 'employee')->first()->id);
            $user->ticket()->create([
                'ticket_number' => Ticket::generateTicketNumber()
            ]);
            $user->attendance()->create([
                'arrival_date' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        });

        $sampleCandidate = $admin;

        $survey = Survey::create([
            'name' => 'Best Outfit',
            'year' => Carbon::now()->year
        ]);
        $candidate = $survey->candidates()->create([
            'user_id' => $sampleCandidate->id,
        ]);
        $employee->votes()->create([
            'survey_candidate_id' => $candidate->id,
        ]);
    }
}
