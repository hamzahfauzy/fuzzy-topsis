<?php

use Core\Database;

$db = new Database;
$db->delete('penilaian', ['puskesmas_id' => $_GET['id']]);
$db->query = "UPDATE puskesmas SET waktu_penilaian = NULL WHERE id = $_GET[id]";
$db->exec();

// set_flash_msg(['success'=>"Penilaian berhasil dihapus"]);

header('location:'.routeTo('puskesmas/hasil/index'));
die();