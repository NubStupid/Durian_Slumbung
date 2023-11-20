DROP DATABASE IF EXISTS durian_slumbung;
CREATE DATABASE durian_slumbung;

USE durian_slumbung;

CREATE TABLE olahan(
    nama VARCHAR(25) PRIMARY KEY,
    img VARCHAR(25)
);

CREATE TABLE book_olahan(
    inv_id VARCHAR(25) PRIMARY KEY,
    tgl_pesan DATE,
    tgl_dipesan DATE,
    sesi VARCHAR(255),
    olahan VARCHAR(255),
    nama VARCHAR(255),
    nowa VARCHAR(255),
    orang INT,
    bukti_bayar VARCHAR(255),
    status INT(3)
);

CREATE TABLE stok_durian(
    tanggal DATE PRIMARY KEY,
    kecil INT,
    sedang INT,
    besar INT
);

CREATE TABLE book_durian(
    inv_id VARCHAR(25) PRIMARY KEY,
    tgl_pesan DATE,
    tgl_dipesan DATE,
    nama VARCHAR(25),
    nowa VARCHAR(25),
    kecil INT,
    sedang INT,
    besar INT,
    bukti_bayar VARCHAR(255),
    status INT(3)
);  