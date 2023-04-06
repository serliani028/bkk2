<?php

include "koneksi.php";

function getModul(){
    $tampil=mysqli_query($GLOBALS['link'], "SELECT nama FROM modul ORDER BY nama ASC")->result();

    echo json_encode($tampil);
}
?>

