<?php
$db_host        = 'cybersjob.com';
$db_user        = 'u1328132_devtalent';
$db_pass        = 'Cybers2021!';
$db_database    = 'u1328132_devtalent'; 
$db_port        = '3306';

global $link;

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database, $db_port) or die('Unable to establish a NHT_DB connection');