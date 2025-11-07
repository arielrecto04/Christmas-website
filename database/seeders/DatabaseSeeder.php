<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\User;
use App\Models\Employee;
use App\Models\Role;
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

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'ticket_number' => 'TICKET-' . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT),
            'password' => Hash::make('admin123')
        ]);

        $user->roles()->attach(Role::where('name', 'admin')->first()->id);

        $user = Attendance::create([
            'user_id' => $user->id,
            'arrival_date' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        $employees = [
            "RHD1",
            "PHD",
            "VHD",
            "RHD2",
            "Ronan Vilela Manzanares",
            "Montano Castillo Plata",
            "Anthony Saldon Garingaloa",
            "Dan Brian Gamulo Perez",
            "Andie Cabahug Hofstetter",
            "Jay Salazar Pantallano",
            "Jan Karl Bautista Brao",
            "Angeline Caparino Boton",
            "Dave Vincin Mendoza Giron",
            "Alfer Dave Alviz",
            "Efren Guilas Jr.",
            "Joseph C. Galisim",
            "Joshua Bagayan",
            "John Emerson Banares",
            "Henry Ganal",
            "Gerald Paul Ruga",
            "Aries T. Castro",
            "DJ Boy Supsup",
            "Mary Jane Restrivera",
            "Vincent Anthony R. Bajenting",
            "Ariel Recto",
            "Shen Ramil",
            "Paul John Bulangay",
            "Leriza Rolea"
        ];

        collect($employees)->map(function($employee){
            $user = User::create([
                'name' => $employee,
                'slug' => Str::slug($employee),
                'email' => Str::slug($employee) . '@gmail.com',
                'password' => Hash::make('password'),
                'ticket_number' => 'TICKET-' . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT),
            ]);

            $user->roles()->attach(Role::where('name', 'employee')->first()->id);

            Attendance::create([
                'user_id' => $user->id,
                'arrival_date' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        });
    }
}
