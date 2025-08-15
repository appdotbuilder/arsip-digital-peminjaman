<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Village;
use Illuminate\Database\Seeder;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $villagesData = [
            'Brati' => ['Brati', 'Ketileng', 'Kramat', 'Mojoagung', 'Ngraho'],
            'Gabus' => ['Gabus', 'Banjarsari', 'Kedungmutih', 'Pringapus', 'Sukorejo'],
            'Geyer' => ['Geyer', 'Kedungjati', 'Mojokerto', 'Ngablak', 'Tegalrejo'],
            'Godong' => ['Godong', 'Bakaran', 'Ketileng', 'Mojosongo', 'Turi'],
            'Grobogan' => ['Grobogan', 'Gubug', 'Kedungrejo', 'Krajan', 'Ngagel'],
            'Gubug' => ['Gubug', 'Banjarsari', 'Kedungpring', 'Mojoroto', 'Watu'],
            'Karangrayung' => ['Karangrayung', 'Jetis', 'Kedungmulyo', 'Pandes', 'Sumberejo'],
            'Kedungjati' => ['Kedungjati', 'Baleharjo', 'Jatisari', 'Ngablak', 'Weru'],
            'Klambu' => ['Klambu', 'Gedangan', 'Kepoh', 'Ngemplak', 'Sumberagung'],
            'Kradenan' => ['Kradenan', 'Jetis', 'Kedungleper', 'Ngabean', 'Wates'],
            'Ngaringan' => ['Ngaringan', 'Banjarsari', 'Kedungringin', 'Mojorejo', 'Tegalsari'],
            'Penawangan' => ['Penawangan', 'Kedung', 'Mojoroto', 'Ngemplak', 'Trimulyo'],
            'Pulokulon' => ['Pulokulon', 'Banggle', 'Kedungpring', 'Ngadirejo', 'Wonokerto'],
            'Purwodadi' => ['Purwodadi', 'Banjarsari', 'Kedungringin', 'Ngablak', 'Tegalsari'],
            'Tanggungharjo' => ['Tanggungharjo', 'Jetis', 'Kedungmulyo', 'Ngadirejo', 'Wonokromo'],
            'Tawangharjo' => ['Tawangharjo', 'Kedungjati', 'Mojokerto', 'Ngemplak', 'Sumberejo'],
            'Tegowanu' => ['Tegowanu', 'Banjarsari', 'Kedungpring', 'Ngadirejo', 'Trimulyo'],
            'Toroh' => ['Toroh', 'Gedangan', 'Kedungringin', 'Mojorejo', 'Wonokerto'],
            'Wirosari' => ['Wirosari', 'Banggle', 'Kedungleper', 'Ngabean', 'Tegalsari'],
        ];

        foreach ($villagesData as $districtName => $villages) {
            $district = District::where('name', $districtName)->first();
            
            if ($district) {
                foreach ($villages as $index => $villageName) {
                    Village::create([
                        'district_id' => $district->id,
                        'name' => $villageName,
                        'code' => $district->code . sprintf('%02d', $index + 1),
                    ]);
                }
            }
        }
    }
}