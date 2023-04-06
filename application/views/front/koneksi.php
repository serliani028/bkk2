<?php
$db_host        = '103.31.38.193';
$db_user        = 'psikotest';
$db_pass        = 'Cybers2021';
$db_database    = 'psikotest'; 
$db_port        = '3306';

global $link;

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database, $db_port) or die('Unable to establish a NHT_DB connection');