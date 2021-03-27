<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "id_level" => 2,
            "name" => "supervisor",
            "email" => "supervisor@gmail.com",
            "password" => bcrypt(123),
        ]);
    }
}
