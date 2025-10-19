<?php

use Core\Database;
use Core\Page;

$db        = new Database;
$success_msg = get_flash_msg('success');
$error_msg = get_flash_msg('error');
$old       = get_flash_msg('old');

$puskesmas = $db->all('puskesmas', 'waktu_penilaian IS NULL');
$kriteria  = $db->all('kriteria');
$skala     = $db->all('skala');

Page::setTitle('Penilaian');

return view('puskesmas/views/penilaian/index', compact('puskesmas','kriteria','skala','error_msg','success_msg','old'));