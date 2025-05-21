<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InitialUserAndStacksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'cliente@cloudwings.com.br'],
            [
                'name' => 'Cliente CloudWings',
                'password' => Hash::make('senha123'),
            ]
        );

        $user->stacks()->delete();

        $user->stacks()->createMany([
            [
                'name' => 'WordPress Loja',
                'status' => 'active',
                'url' => 'https://loja.cloudwings.com.br',
                'active_time' => '5h 23min',
            ],
            [
                'name' => 'Mini ERP',
                'status' => 'starting',
                'url' => 'https://erp.cloudwings.com.br',
                'active_time' => null,
            ],
            [
                'name' => 'API Cloud Wings',
                'status' => 'offline',
                'url' => 'https://api.cloudwings.com.br',
                'active_time' => null,
            ],
        ]);
    }
}
