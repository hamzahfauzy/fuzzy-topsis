<?php

use Core\Database;
use Modules\Puskesmas\Libraries\FuzzyTopsis;

$db = new Database;

$kriteria  = $db->all('kriteria');

$puskesmas = $db->all('puskesmas', 'waktu_penilaian IS NOT NULL');

$kriteriaMap = [];

$criterias = [];
foreach($kriteria as $k)
{
    $criterias[] = [
        'id' => $k->id,
        'type' => $k->jenis,
        'weight' => $k->bobot
    ];
    $kriteriaMap[$k->id] = $k;
}

$alternatives = [];
$puskesmasMap = [];
foreach($puskesmas as $p)
{
    $values = [];
    $penilaian = $db->all('penilaian', [
        'puskesmas_id' => $p->id
    ]);
    foreach($penilaian as $pen)
    {
        $values[$pen->kriteria_id] = [
            $pen->skala_l,
            $pen->skala_m,
            $pen->skala_u,
        ];
    }
    $alternatives[] = [
        'id' => $p->id,
        'name' => $p->nama,
        'values' => $values
    ];

    $puskesmasMap[$p->id] = $p;
}

$topsis = new FuzzyTopsis($criterias, $alternatives);
$results = $topsis->process();

// return $results;

// return [
//     $topsis->normalizedResult,
//     $topsis->weightResult,
//     $topsis->distanceResult,
//     $topsis->fpfn,
// ];

return view('puskesmas/views/hasil/index', [
    'results' => $results,
    'kriteriaMap' => $kriteriaMap,
    'puskesmas' => $puskesmas,
]);