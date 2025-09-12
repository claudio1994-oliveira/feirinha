<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            ['name' => 'Maria Silva', 'email' => 'maria@example.com', 'phone' => '(11) 99999-1111'],
            ['name' => 'João Santos', 'email' => 'joao@example.com', 'phone' => '(11) 99999-2222'],
            ['name' => 'Ana Costa', 'email' => 'ana@example.com', 'phone' => '(11) 99999-3333'],
            ['name' => 'Carlos Pereira', 'email' => null, 'phone' => '(11) 99999-4444'],
        ];

        foreach ($customers as $data) {
            \App\Models\Customer::firstOrCreate(
                ['email' => $data['email']],
                $data
            );
        }
    }
}
