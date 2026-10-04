```sql
CREATE DATABASE IF NOT EXISTS telkom_profile;
USE telkom_profile;

CREATE TABLE IF NOT EXISTS program_studi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    jenjang VARCHAR(20) NOT NULL,
    deskripsi TEXT
);

CREATE TABLE IF NOT EXISTS berita (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(200) NOT NULL,
    ringkasan TEXT,
    tanggal_publish DATE
);

CREATE TABLE IF NOT EXISTS pesan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    pesan TEXT NOT NULL
);
```
