<?php

include "koneksi.php";

function getStatusByKode($kode){
    $tampil=mysqli_query($GLOBALS['link'], "SELECT nomor,p.nama,k.status,k.progress,k.modul,k.klien,jenis_kelamin,usia,tingkat_pendidikan,p.tanggal_entry FROM peserta p,komputer k 
        WHERE p.nomor=k.IP AND nomor='".$kode."' ORDER BY k.tanggal_entry DESC");

    return $tampil->fetch_assoc()['status'];
}

function getProgressByKode($kode){
    $tampil=mysqli_query($GLOBALS['link'], "SELECT nomor,p.nama,k.status,k.progress,k.modul,k.klien,jenis_kelamin,usia,tingkat_pendidikan,p.tanggal_entry FROM peserta p,komputer k 
        WHERE p.nomor=k.IP AND nomor='".$kode."' ORDER BY k.tanggal_entry DESC");

    return $tampil->fetch_assoc()['progress'];
}

?>