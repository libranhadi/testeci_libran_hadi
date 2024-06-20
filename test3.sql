CREATE TABLE department (
    id_dept BIGINT AUTO_INCREMENT PRIMARY KEY,
    nama_dept VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL
);

CREATE TABLE level (
    id_level BIGINT AUTO_INCREMENT PRIMARY KEY,
    nama_level VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL
);

CREATE TABLE jabatan (
    id_jabatan BIGINT AUTO_INCREMENT PRIMARY KEY,
    nama_jabatan VARCHAR(100),
    id_level BIGINT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL,
    INDEX idx_id_level (id_level),
    FOREIGN KEY (id_level) REFERENCES level(id_level)
);

CREATE TABLE karyawan (
    id_karyawan BIGINT AUTO_INCREMENT PRIMARY KEY,
    nik VARCHAR(10) UNIQUE,
    nama VARCHAR(100),
    ttl DATE,
    alamat TEXT,
    id_jabatan BIGINT,
    id_dept BIGINT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL,
    INDEX idx_id_jabatan (id_jabatan),
    INDEX idx_id_dept (id_dept),
	 FOREIGN KEY (id_dept) REFERENCES department(id_dept),
    FOREIGN KEY (id_jabatan) REFERENCES jabatan(id_jabatan)
);

INSERT INTO department (nama_dept) VALUES
('HR Department'),
('IT Department'),
('Creative Department');

INSERT INTO level (nama_level) VALUES
('Senior'),
('Associate'),
('Junior');

INSERT INTO jabatan (nama_jabatan, id_level) VALUES
('Manager', 1),
('Supervisor', 2),
('Staff', 3);


INSERT INTO karyawan (nik, nama, ttl, alamat, id_jabatan, id_dept) VALUES
('19990515', 'Steve', '1999-05-15', 'Jl. Majapahit', 1, 1),
('19990516', 'Steven II', '1999-05-16', 'Jl. Majapahit II', 2, 2),
('19990517', 'Steven III', '1999-05-17', 'Jl. Majapahit III', 3, 3);


SELECT 
    karyawan.nama AS nama_karyawan,
    jabatan.nama_jabatan AS nama_jabatan,
    department.nama_dept AS nama_departemen,
    level.nama_level AS nama_level
FROM 
    karyawan
    JOIN jabatan ON karyawan.id_jabatan = jabatan.id_jabatan
    JOIN level ON jabatan.id_level = level.id_level
    JOIN department ON karyawan.id_dept = department.id_dept
    WHERE karyawan.deleted_at IS NULL 
    AND jabatan.deleted_at IS NULL 
    AND department.deleted_at IS NULL 
    AND level.deleted_at IS NULL;


UPDATE karyawan
SET nama = 'Kurniawan'
WHERE id_karyawan = 1;

DELETE FROM karyawan
WHERE id_karyawan = 1;

-- SOFT DELETE 
UPDATE karyawan
SET deleted_at = CURRENT_TIMESTAMP
WHERE id_karyawan = 2;