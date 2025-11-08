<?php

use Core\Database;
use Core\Request;
use Core\Page;

$db = new Database;

$success_msg = get_flash_msg('success');
$error_msg = get_flash_msg('error');
$old       = get_flash_msg('old');

if(Request::isMethod('POST'))
{
    $db->delete('penilaian', ['puskesmas_id' => $_GET['id']]);
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
}

$puskesmas = $db->single('puskesmas', ['id' => $_GET['id']]);
$kriteria  = $db->all('kriteria');
$skala     = $db->all('skala');
$penilaian = $db->all('penilaian', ['puskesmas_id' => $_GET['id']]);

$nilai = [];
foreach($penilaian as $p)
{
    $nilai[$p->kriteria_id] = $p->label;
}

Page::setTitle('Penilaian');

return view('puskesmas/views/penilaian/edit', compact('puskesmas','kriteria','skala','error_msg','success_msg','old','nilai'));
