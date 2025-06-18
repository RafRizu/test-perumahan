<?php

namespace Database\Seeders;

use App\Models\UnitGroup;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UnitGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $unitGroups = [
            ['name' => 'A1'],
            ['name' => 'A2'],
            ['name' => 'A3'],
            ['name' => 'A4'],
            ['name' => 'A5'],
            ['name' => 'A6'],
            ['name' => 'A7'],
            ['name' => 'A8'],
            ['name' => 'A9'],
            ['name' => 'B1'],
            ['name' => 'B2'],
            ['name' => 'B3'],
            ['name' => 'B4'],
            ['name' => 'B5'],
            ['name' => 'B6'],
            ['name' => 'C1'],
            ['name' => 'C2'],
            ['name' => 'C3'],
            ['name' => 'C4'],
            ['name' => 'C5'],
            ['name' => 'C6'],
            ['name' => 'D1'],
            ['name' => 'D2'],
            ['name' => 'D3'],
            ['name' => 'E1'],
            ['name' => 'E2'],
            ['name' => 'E3'],
        ];

        foreach ($unitGroups as $unitGroup) {
            UnitGroup::create([
                'name' => $unitGroup['name'],
            ]);
        }
    }
}
