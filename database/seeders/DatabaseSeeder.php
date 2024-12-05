<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Employee;
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

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123')
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
            Employee::create([
                'name' => $employee,
                'slug' => Str::slug($employee),
                'ticket_number' => 'TICKET-' . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT),
            ]);
        });
    }
}
