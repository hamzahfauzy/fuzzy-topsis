<?php 

return [
    'puskesmas' => [
        'nama' => [
            'label' => 'Nama',
            'type'  => 'text',
        ],
        'alamat' => [
            'label' => 'Alamat',
            'type'  => 'textarea',
        ],
        'waktu_penilaian' => [
            'label' => 'Waktu Penilaian',
            'type'  => 'datetime',
        ],
    ],

    'kriteria' => [
        'nama' => [
            'label' => 'Nama',
            'type'  => 'text',
        ],
        'keterangan' => [
            'label' => 'Keterangan',
            'type'  => 'textarea',
        ],
        'jenis' => [
            'label' => 'Jenis',
            'type'  => 'options:benefit|cost',
        ],
        'bobot' => [
            'label' => 'Bobot',
            'type'  => 'number',
        ],
    ],

    'skala' => [
        'label' => [
            'label' => 'Label',
            'type'  => 'text',
        ],
        'lower_limit' => [
            'label' => 'Lower Limit (l)',
            'type'  => 'number',
        ],
        'middle_limit' => [
            'label' => 'Middle Limit (m)',
            'type'  => 'number',
        ],
        'upper_limit' => [
            'label' => 'Upper Limit (u)',
            'type'  => 'number',
        ],
    ],

    // 'penilaian' => [
    //     'puskesmas_id' => [
    //         'label' => 'Puskesmas',
    //         'type'  => 'options-obj:puskesmas,id,nama',
    //     ],
    //     'kriteria_id' => [
    //         'label' => 'Kriteria',
    //         'type'  => 'options-obj:kriteria,id,nama',
    //     ],
    //     'label' => [
    //         'label' => 'Label Linguistik',
    //         'type'  => 'select',
    //         'relation' => 'skala',
    //     ],
    //     'skala_l' => [
    //         'label' => 'Nilai Lower (l)',
    //         'type'  => 'number',
    //         'step'  => '0.01',
    //     ],
    //     'skala_m' => [
    //         'label' => 'Nilai Middle (m)',
    //         'type'  => 'number',
    //         'step'  => '0.01',
    //     ],
    //     'skala_u' => [
    //         'label' => 'Nilai Upper (u)',
    //         'type'  => 'number',
    //         'step'  => '0.01',
    //     ],
    // ],
];