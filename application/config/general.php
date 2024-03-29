<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['kib'] = [
    '01'=>['id'=>'A', 'name'=>'Tanah'],
    '02'=>['id'=>'B', 'name'=>'Peralatan dan Mesin'],
    '03'=>['id'=>'C', 'name'=>'Gedung dan Bangunan'],
    '04'=>['id'=>'D', 'name'=>'Jalan Irigasi dan Jaringan'],
    '05'=>['id'=>'E', 'name'=>'Aset Tetap Lainnya'],
    '06'=>['id'=>'F', 'name'=>'Kontruksi Dalam Pengerjaan'],
    '00'=>['id'=>'Z', 'name'=>'Aset Tak Berwujud'],
];

$config['metode'] = [
    1=>['id'=>'periodik', 'name'=>'Periodik/Beban'],
    2=>['id'=>'perpetual', 'name'=>'Perpetual/Aset']
];

$config['kib_info_tipe'] = [
    'teks',
    'tanggal',
    'pilihan',
    'angka',
    'uang',
    'keterangan',
];

$config['kab'] = 'Kabupaten Mamberamo Tengah';