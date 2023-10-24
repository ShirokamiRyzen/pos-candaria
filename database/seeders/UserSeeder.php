<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
            'name' => 'Fatih Firdaus'
        ], [
            'name' => 'Fatih Firdaus',
            'email' => 'fatih@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 1,
        ]);
    }
}
