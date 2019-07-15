<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Администратор',
            'last_name' => 'Администратор',
            'email' => 'admin@admin.mi',
            'role' => 'admin',
            'password' => \Hash::make('AiTbn6ylil'),
        ]);
    }
}
