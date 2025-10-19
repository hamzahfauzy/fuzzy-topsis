CREATE TABLE puskesmas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    alamat TEXT DEFAULT NULL,
    waktu_penilaian DATETIME DEFAULT NULL
);

CREATE TABLE kriteria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    keterangan TEXT DEFAULT NULL,
    jenis VARCHAR(100) NOT NULL,
    bobot DOUBLE(11, 2) NOT NULL
);

CREATE TABLE skala (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(100) NOT NULL,
    lower_limit DOUBLE(11, 2) NOT NULL,
    middle_limit DOUBLE(11, 2) NOT NULL,
    upper_limit DOUBLE(11, 2) NOT NULL
);

CREATE TABLE penilaian (
    id INT AUTO_INCREMENT PRIMARY KEY,
    puskesmas_id INT NOT NULL,
    kriteria_id INT NOT NULL,
    label VARCHAR(50) NOT NULL, -- linguistic label chosen by evaluator
    skala_l DOUBLE(11, 2) NOT NULL, -- TFN lower
    skala_m DOUBLE(11, 2) NOT NULL, -- TFN middle
    skala_u DOUBLE(11, 2) NOT NULL, -- TFN upper
    FOREIGN KEY (puskesmas_id) REFERENCES puskesmas(id) ON DELETE CASCADE,
    FOREIGN KEY (kriteria_id) REFERENCES kriteria(id) ON DELETE CASCADE
);

