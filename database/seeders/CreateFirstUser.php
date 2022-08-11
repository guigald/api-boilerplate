<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateFirstUser extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'document' => '99999999999',
            'password' => Hash::make('Tests@123.'),
        ]);
    }

    public function rollback()
    {
        DB::table('users')
        ->where('email', 'admin@email.com')
        ->delete();
    }
}
