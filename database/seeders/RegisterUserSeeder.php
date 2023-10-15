<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegisterUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::where('email','nnady988@gmail.com')->delete();
        User::create([
            'name'=>'Mostafa Ahmed',
            'email'=>'nnady988@gmail.com',
            'password'=>'$2y$10$HZFkUHXcuAMXF3BCDDbehOvdmC4k0KQN8YSbtSvSHSh8scC.egd02',
            'address'=>'tanta',
            'phone'=>'0123',
        ]);
    }
}
