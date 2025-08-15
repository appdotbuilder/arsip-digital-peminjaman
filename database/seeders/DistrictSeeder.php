<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = [
            ['name' => 'Brati', 'code' => 'BRT'],
            ['name' => 'Gabus', 'code' => 'GBS'],
            ['name' => 'Geyer', 'code' => 'GYR'],
            ['name' => 'Godong', 'code' => 'GDG'],
            ['name' => 'Grobogan', 'code' => 'GRB'],
            ['name' => 'Gubug', 'code' => 'GBG'],
            ['name' => 'Karangrayung', 'code' => 'KRG'],
            ['name' => 'Kedungjati', 'code' => 'KDJ'],
            ['name' => 'Klambu', 'code' => 'KLB'],
            ['name' => 'Kradenan', 'code' => 'KRD'],
            ['name' => 'Ngaringan', 'code' => 'NGR'],
            ['name' => 'Penawangan', 'code' => 'PNW'],
            ['name' => 'Pulokulon', 'code' => 'PLK'],
            ['name' => 'Purwodadi', 'code' => 'PWD'],
            ['name' => 'Tanggungharjo', 'code' => 'TGH'],
            ['name' => 'Tawangharjo', 'code' => 'TWH'],
            ['name' => 'Tegowanu', 'code' => 'TGW'],
            ['name' => 'Toroh', 'code' => 'TRH'],
            ['name' => 'Wirosari', 'code' => 'WRS'],
        ];

        foreach ($districts as $district) {
            District::create($district);
        }
    }
}