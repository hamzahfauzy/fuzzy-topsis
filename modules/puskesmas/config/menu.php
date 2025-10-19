<?php 

return [
    [
        'label' => 'puskesmas.menu.puskesmas',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-hospital',
        'route' => routeTo('crud/index',['table'=>'puskesmas']),
        'activeState' => 'puskesmas.puskesmas'
    ],
    [
        'label' => 'puskesmas.menu.kriteria',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-cubes',
        'route' => routeTo('crud/index',['table'=>'kriteria']),
        'activeState' => 'puskesmas.kriteria'
    ],
    [
        'label' => 'puskesmas.menu.skala',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-th-list',
        'route' => routeTo('crud/index',['table'=>'skala']),
        'activeState' => 'puskesmas.skala'
    ],
    [
        'label' => 'puskesmas.menu.penilaian',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-pencil',
        'route' => routeTo('puskesmas/penilaian/index'),
        'activeState' => 'puskesmas.penilaian'
    ],
    [
        'label' => 'puskesmas.menu.hasil',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-print',
        'route' => routeTo('puskesmas/hasil/index'),
        'activeState' => 'puskesmas.hasil'
    ],
];