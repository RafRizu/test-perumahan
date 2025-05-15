<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $units = [
            ['unit_group_id' => 1, 'start' => 1, 'end' => 8],
            ['unit_group_id' => 2, 'start' => 1, 'end' => 18],
            ['unit_group_id' => 3, 'start' => 1, 'end' => 15],
            ['unit_group_id' => 4, 'start' => 1, 'end' => 18],
            ['unit_group_id' => 5, 'start' => 1, 'end' => 18],
            ['unit_group_id' => 6, 'start' => 1, 'end' => 18],
            ['unit_group_id' => 7, 'start' => 1, 'end' => 9],
            ['unit_group_id' => 8, 'start' => 1, 'end' => 18],
            ['unit_group_id' => 9, 'start' => 1, 'end' => 18],
            //B
            ['unit_group_id' => 10, 'start' => 1, 'end' => 18],
            ['unit_group_id' => 11, 'start' => 1, 'end' => 18],
            ['unit_group_id' => 12, 'start' => 1, 'end' => 18],
            ['unit_group_id' => 13, 'start' => 1, 'end' => 18],
            ['unit_group_id' => 14, 'start' => 1, 'end' => 18],
            ['unit_group_id' => 15, 'start' => 1, 'end' => 16],
            //C
            ['unit_group_id' => 16, 'start' => 1, 'end' => 11],
            ['unit_group_id' => 17, 'start' => 1, 'end' => 18],
            ['unit_group_id' => 18, 'start' => 1, 'end' => 18],
            ['unit_group_id' => 19, 'start' => 1, 'end' => 6],
            ['unit_group_id' => 20, 'start' => 1, 'end' => 10],
            ['unit_group_id' => 21, 'start' => 1, 'end' => 5],
            //D
            ['unit_group_id' => 22, 'start' => 1, 'end' => 14],
            ['unit_group_id' => 23, 'start' => 1, 'end' => 14],
            ['unit_group_id' => 24, 'start' => 1, 'end' => 7],
            //E
            ['unit_group_id' => 25, 'start' => 1, 'end' => 14],
            ['unit_group_id' => 26, 'start' => 1, 'end' => 6],
            ['unit_group_id' => 27, 'start' => 1, 'end' => 5],

        ];
        $name = 'Unit - ';
        foreach ($units as $unit) {
            for ($i = $unit['start']; $i <= $unit['end']; $i++) {
                Unit::firstOrCreate([
                    'unit_group_id' => $unit['unit_group_id'],
                    'name' => $name . $i,
                ]);
            }
        }
    }
}
