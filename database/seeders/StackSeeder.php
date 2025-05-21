<?php

namespace Database\Seeders;

use App\Models\Stack;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        Stack::truncate();

        $user->stacks()->createMany([
            [
                'name' => 'WordPress Loja',
                'status' => 'ativo',
                'url' => 'https://loja.cloudwings.com.br',
                'active_time' => '5h 23min',
            ],
            [
                'name' => 'Mini ERP',
                'status' => 'iniciando',
                'url' => 'https://erp.cloudwings.com.br',
                'active_time' => null,
            ],
            [
                'name' => 'API Cloud Wings',
                'status' => 'offline',
                'url' => 'https://api.cloudwings.com.br',
                'active_time' => '5h 23min',
            ],
        ]);

    }
}
