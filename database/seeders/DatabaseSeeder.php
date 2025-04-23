<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        // User::factory()->create([
        //     'name' => 'Daniel Moran Vilchez',
        //     'dni' => '70315050',
        //     'email' => 'daniel@djasoft.com',
        //     'is_active' => true,
        //     'password' => Hash::make('admin3264'),
        // ]);

        User::factory()->create([
            'name' => 'Juan Pérez',
            'dni' => '70315051',
            'email' => 'juan1@djasoft.com',
            'is_active' => true,
            'password' => Hash::make('admin3264'),
        ]);
        // User::factory()->create([
        //     'name' => 'Juan Pérez',
        //     'dni' => '70315052',
        //     'email' => 'juan2@djasoft.com',
        //     'is_active' => true,
        //     'password' => Hash::make('admin3264'),
        //     'company' => 'DjaSoft',
        // ]);
        // User::factory()->create([
        //     'name' => 'Juan Pérez',
        //     'dni' => '70315053',
        //     'email' => 'juan3@djasoft.com',
        //     'is_active' => true,
        //     'password' => Hash::make('admin3264'),
        //     'company' => 'DjaSoft',
        // ]);
        // User::factory()->create([
        //     'name' => 'Juan Pérez',
        //     'dni' => '70315054',
        //     'email' => 'juan4@djasoft.com',
        //     'is_active' => true,
        //     'password' => Hash::make('admin3264'),
        //     'company' => 'DjaSoft',
        // ]);
    }
}
