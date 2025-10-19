<?php

use Core\Database;

$db = new Database;
$skala = $db->all('skala');
$skalaMap = [];
foreach($skala as $s)
{
    $skalaMap[$s->id] = $s;
}

foreach($_POST['kriteria'] as $kriteria_id => $skala_id)
{
    $skala = $skalaMap[$skala_id];
    $db->insert('penilaian', [
        'puskesmas_id' => $_POST['puskesmas_id'],
        'kriteria_id' => $kriteria_id,
        'label' => $skala->label,
        'skala_l' => $skala->lower_limit,
        'skala_m' => $skala->middle_limit,
        'skala_u' => $skala->upper_limit,
    ]);

}

$db->update('puskesmas', ['waktu_penilaian' => date('Y-m-d H:i:s')], ['id' => $_POST['puskesmas_id']]);

set_flash_msg(['success'=>"Penilaian berhasil disimpan"]);

header('location:'.routeTo('puskesmas/penilaian/index'));
die();