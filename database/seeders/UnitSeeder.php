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

        // WARN: "Ukuran si tiap kotak bukan nya fixed yaa? yaudah deh" - chad zan
        $unitSize = 15; // ukuran tiap kotak unit
        $gap = 3; // jarak antar kotak
        $startTop = 100; // titik Y awal
        $startLeft = 700; // titik X awal

        $id = 1;
        foreach ($units as $index => $unit) {
            $row = 0;
            $col = 0;

            for ($i = $unit['start']; $i <= $unit['end']; $i++) {
                // NOTE: Dibagi untuk mendapatkan persentase, berdasarkan ukuran gambar 901x1278
                // Hitung nilai kanan kiri, dibagi ukuran (panjang/tinggi) kemudian di kali 100
                $left = ($startLeft + ($col * ($unitSize + $gap))) / 901 * 100;
                $top = ($startTop + ($index * 20)) / 1279 * 100; // jarak antar baris grup

                Unit::updateOrCreate([
                    'id' => $id++,
                    'unit_group_id' => $unit['unit_group_id'],
                    'name' => 'Unit - ' . $i,
                ], [
                    'top' => $top,
                    'left' => $left,
                    'width' => $unitSize,
                    'height' => $unitSize,
                ]);

                $col++;
            }
        }
    }

}
