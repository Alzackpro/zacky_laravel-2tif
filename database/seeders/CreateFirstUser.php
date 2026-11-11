<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'     => 'Admin zaf_BPF',
            'email'    => 'admin@zafbpf.test',
            'password' => Hash::make('password123'),
        ]);
    }
}
