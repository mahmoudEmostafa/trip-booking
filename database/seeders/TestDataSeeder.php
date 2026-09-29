<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        $employee = Employee::create([
            'name' => 'Ahmad Employee',
            'phone' => '0999999999',
        ]);

        Customer::create([
            'name' => 'Mahmoud Customer',
            'phone' => '0988888888',
        ]);

        $bus = Bus::create([
            'number' => 'BUS-001',
        ]);

        for ($i = 1; $i <= 10; $i++) {
            $bus->seats()->create([
                'seat_number' => $i,
            ]);
        }
    }
}