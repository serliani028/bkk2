<?php
	include('koneksi.php');
	
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

    $jumlah = addslashes (strip_tags (1));
    $modul = addslashes (strip_tags ('Modul Test 1'));
    $klien = addslashes (strip_tags ('internal'));
    $bayar = addslashes (strip_tags (1));
    $harga = addslashes (strip_tags (1));
    $expiry = addslashes (strip_tags (NULL));
    
    $i = 1;

    $kunci=generate_kunci();

	$query="SELECT count(IP) as jml FROM komputer WHERE ip='$kunci'";

	$sql = mysqli_query ($link, $query) or die (mysql_error());

	$datanya=$sql->fetch_assoc();

	if(empty($datanya['jml']))
	{

        $query="INSERT INTO komputer (IP,modul,nama,klien,paid,harga,expiry,tanggal_entry) VALUES ('$kunci','$modul','admintes','$klien','$bayar','$harga','$expiry',NOW())";

       	$sql = mysqli_query ($link, $query) or die (mysql_error());

      	$i++;
    
        var_dump($sql);
    }else{
    	var_dump('duplicate');
    }