INSERT INTO kriteria (nama,keterangan,jenis,bobot) VALUES
("Kualitas Pelayanan Kesehatan", "Kecepatan, ketepatan, keramahan, dan kepuasan pasien", "benefit", 0.5),
("Kelengkapan Fasilitas dan Peralatan", "Jumlah dan kondisi alat kesehatan, ruang perawatan, laboratorium, dll", "benefit", 0.5),
("Kinerja SDM (Tenaga Kesehatan)", "Kompetensi, kedisiplinan, kehadiran, dan profesionalisme staf", "benefit", 0.5),
("Cakupan Program Kesehatan Masyarakat","Persentase program (imunisasi, gizi, KIA, lingkungan) yang tercapai","benefit", 0.5),
("Efisiensi Anggaran dan Pengelolaan Keuangan","Rasio realisasi anggaran terhadap output pelayanan","cost", 0.5),
("Inovasi dan Peningkatan Mutu Layanan","Adanya inovasi pelayanan dan perbaikan sistem kerja","benefit", 0.5),
("Kepuasan Masyarakat","Tingkat kepuasan pasien dan masyarakat terhadap pelayanan","benefit", 0.5),
("Kelengkapan Administrasi dan Pelaporan","Ketepatan dan kelengkapan laporan kegiatan dan data","benefit", 0.5);

INSERT INTO skala (label, lower_limit, middle_limit, upper_limit) VALUES
("Sangat Buruk (SB)", 0, 0, 0.25),
("Buruk (B)", 0, 0.25, 0.5),
("Cukup (C)", 0.25, 0.5, 0.75),
("Baik (Ba)", 0.5, 0.75, 1.0),
("Sangat Baik (SBa)", 0.75, 1.0, 1.0);