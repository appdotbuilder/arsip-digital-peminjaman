<?php

namespace Database\Seeders;

use App\Models\ArchiveCategory;
use Illuminate\Database\Seeder;

class ArchiveCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Buku Tanah',
                'code' => 'BT',
                'description' => 'Arsip berupa buku tanah dengan berbagai jenis HAK',
                'required_fields' => [
                    'jenis_hak' => [
                        'type' => 'select',
                        'label' => 'Jenis HAK',
                        'options' => [
                            'HGB' => 'Hak Guna Bangunan',
                            'HM' => 'Hak Milik',
                            'HGU' => 'Hak Guna Usaha',
                            'HP' => 'Hak Pakai',
                            'HPL' => 'Hak Pengolahan',
                            'HW' => 'Hak Wakaf',
                            'HMSRS' => 'Hak Milik Satuan Rumah Susun',
                            'HT' => 'Hak Tanggungan'
                        ]
                    ],
                    'nomor_hak' => [
                        'type' => 'text',
                        'label' => 'Nomor HAK'
                    ],
                    'tahun' => [
                        'type' => 'number',
                        'label' => 'Tahun',
                        'required_for' => ['HT']
                    ]
                ]
            ],
            [
                'name' => 'Surat Ukur',
                'code' => 'SU',
                'description' => 'Arsip berupa surat ukur tanah',
                'required_fields' => [
                    'nomor_su' => [
                        'type' => 'text',
                        'label' => 'Nomor SU'
                    ]
                ]
            ],
            [
                'name' => 'Gambar Ukur',
                'code' => 'GU',
                'description' => 'Arsip berupa gambar ukur tanah',
                'required_fields' => [
                    'nomor_gu' => [
                        'type' => 'text',
                        'label' => 'Nomor GU'
                    ]
                ]
            ],
            [
                'name' => 'Warkah',
                'code' => 'WR',
                'description' => 'Arsip berupa warkah/dokumen pendukung',
                'required_fields' => [
                    'nomor_warkah' => [
                        'type' => 'text',
                        'label' => 'Nomor Warkah'
                    ],
                    'tahun' => [
                        'type' => 'number',
                        'label' => 'Tahun'
                    ]
                ]
            ]
        ];

        foreach ($categories as $category) {
            ArchiveCategory::create($category);
        }
    }
}