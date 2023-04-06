<?php
include('koneksi.php');

class Psikotes_Model extends CI_Model 
{
    function generate_kunci($length = 10) {
        $hasilnya1=rand(0, 9);    
        $characters = '0123456789ABCDEFGHJKLMNPQRSTUVWXZ';
        $charactersLength = strlen($characters);
        $hasilnya = '';
        for ($i = 0; $i < $length; $i++) {
            $hasilnya .= $characters[rand(0, $charactersLength - 1)];
        }
        return $hasilnya;
    }

    function generate_kodeAktivasi($banyak,$mod){
        $jumlah = addslashes (strip_tags ($banyak));
        $modul = addslashes (strip_tags ($mod));
        $klien = addslashes (strip_tags (''));
        $bayar = addslashes (strip_tags (1));
        $harga = addslashes (strip_tags (1));
        $expiry = addslashes (strip_tags ('0000-00-00 00:00:00'));
        $kode_hasil = [];    
        $i = 1;
    
        while ($i <= $jumlah):

        $kunci=$this->Psikotes_Model->generate_kunci();
        
        array_push($kode_hasil,$kunci);
    	$query="SELECT count(IP) as jml FROM komputer WHERE ip='$kunci'";
    	$sql = mysqli_query ($GLOBALS['link'],$query) or die ( mysqli_error($GLOBALS['link']));
    	$datanya=$sql->fetch_assoc();
    	
    	if(empty($datanya['jml']))
    	{
            $query="INSERT INTO komputer (IP,modul,nama,klien,paid,harga,expiry,tanggal_entry) VALUES ('$kunci','$modul','admintes','$klien','$bayar','$harga','$expiry',NOW())";
           	$sql = mysqli_query ($GLOBALS['link'], $query)or die( mysqli_error($GLOBALS['link']) );
          	$i++;
        }

        endwhile;

        return $kode_hasil;
        // $kunci = $this->Psikotes_Model->generate_kunci();
    
        // $query="SELECT count(IP) as jml FROM komputer WHERE ip='$kunci'";
    
        // $sql = mysqli_query ($GLOBALS['link'], $query)or die( mysqli_error($GLOBALS['link']) );
    
        // $datanya=$sql->fetch_assoc();
    
        // if(empty($datanya['jml']))
        // {
    
        //     $query="INSERT INTO komputer (IP,modul,nama,klien,paid,harga,expiry,tanggal_entry) VALUES ('$kunci','$modul','admintes','$klien','$bayar','$harga',NOW(),NOW())";
        //     $sql = mysqli_query ($GLOBALS['link'], $query)or die( mysqli_error($GLOBALS['link']) );
        //     $i++;
        
        //     return $kunci;
        // }else{
        //     return 'null';
        // }
    }
}