<?php

namespace Database\Seeders;

use App\Models\Archive;
use App\Models\ArchiveCategory;
use Illuminate\Database\Seeder;

class ArchiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bukuTanah = ArchiveCategory::where('code', 'BT')->first();
        $suratUkur = ArchiveCategory::where('code', 'SU')->first();
        $gambarUkur = ArchiveCategory::where('code', 'GU')->first();
        $warkah = ArchiveCategory::where('code', 'WR')->first();

        // Sample Buku Tanah archives
        $bukuTanahData = [
            [
                'title' => 'Buku Tanah HM No. 001',
                'archive_number' => 'BT-HM-001-2024',
                'archive_data' => [
                    'jenis_hak' => 'HM',
                    'nomor_hak' => '001'
                ]
            ],
            [
                'title' => 'Buku Tanah HGB No. 002',
                'archive_number' => 'BT-HGB-002-2024',
                'archive_data' => [
                    'jenis_hak' => 'HGB',
                    'nomor_hak' => '002'
                ]
            ],
            [
                'title' => 'Buku Tanah HT No. 003',
                'archive_number' => 'BT-HT-003-2024',
                'archive_data' => [
                    'jenis_hak' => 'HT',
                    'nomor_hak' => '003',
                    'tahun' => '2024'
                ]
            ]
        ];

        foreach ($bukuTanahData as $data) {
            Archive::create([
                'archive_category_id' => $bukuTanah->id,
                'title' => $data['title'],
                'archive_number' => $data['archive_number'],
                'archive_data' => $data['archive_data'],
                'description' => 'Sample archive for ' . $data['title']
            ]);
        }

        // Sample Surat Ukur archives
        $suratUkurData = [
            [
                'title' => 'Surat Ukur No. 001/2024',
                'archive_number' => 'SU-001-2024',
                'archive_data' => [
                    'nomor_su' => '001/2024'
                ]
            ],
            [
                'title' => 'Surat Ukur No. 002/2024',
                'archive_number' => 'SU-002-2024',
                'archive_data' => [
                    'nomor_su' => '002/2024'
                ]
            ]
        ];

        foreach ($suratUkurData as $data) {
            Archive::create([
                'archive_category_id' => $suratUkur->id,
                'title' => $data['title'],
                'archive_number' => $data['archive_number'],
                'archive_data' => $data['archive_data'],
                'description' => 'Sample archive for ' . $data['title']
            ]);
        }

        // Sample Gambar Ukur archives
        $gambarUkurData = [
            [
                'title' => 'Gambar Ukur No. GU-001',
                'archive_number' => 'GU-001-2024',
                'archive_data' => [
                    'nomor_gu' => 'GU-001'
                ]
            ],
            [
                'title' => 'Gambar Ukur No. GU-002',
                'archive_number' => 'GU-002-2024',
                'archive_data' => [
                    'nomor_gu' => 'GU-002'
                ]
            ]
        ];

        foreach ($gambarUkurData as $data) {
            Archive::create([
                'archive_category_id' => $gambarUkur->id,
                'title' => $data['title'],
                'archive_number' => $data['archive_number'],
                'archive_data' => $data['archive_data'],
                'description' => 'Sample archive for ' . $data['title']
            ]);
        }

        // Sample Warkah archives
        $warkahData = [
            [
                'title' => 'Warkah No. WR-001/2024',
                'archive_number' => 'WR-001-2024',
                'archive_data' => [
                    'nomor_warkah' => 'WR-001/2024',
                    'tahun' => 2024
                ]
            ],
            [
                'title' => 'Warkah No. WR-002/2024',
                'archive_number' => 'WR-002-2024',
                'archive_data' => [
                    'nomor_warkah' => 'WR-002/2024',
                    'tahun' => 2024
                ]
            ]
        ];

        foreach ($warkahData as $data) {
            Archive::create([
                'archive_category_id' => $warkah->id,
                'title' => $data['title'],
                'archive_number' => $data['archive_number'],
                'archive_data' => $data['archive_data'],
                'description' => 'Sample archive for ' . $data['title']
            ]);
        }
    }
}