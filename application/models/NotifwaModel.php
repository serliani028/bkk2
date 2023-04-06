<?php
include('koneksi.php');

class NotifwaModel extends CI_Model 
{
    public function kirim($nomorwa,$pesanwa){

    $angka = "$nomorwa";
    $message = "$pesanwa";
    $singkatan = substr($angka, 0,1);
    $singkatan2 = substr($angka, 1);
    if($singkatan==0){$number='62'.$singkatan2;}
    else{$number=$angka;}
    
    $curl = curl_init();
    curl_setopt_array($curl, array(CURLOPT_URL => 'https://prakerja.bencoolencoffee.com/test2/testapi.php?num='.$number.'&msg='.urlencode(utf8_encode($message)),CURLOPT_RETURNTRANSFER => true,CURLOPT_TIMEOUT => 3));
    $response = curl_exec($curl);
    curl_close($curl);
    }
}