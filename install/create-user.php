<?php

include('includes.php');
ini_set('display_errors', 0);
error_reporting(0);

$data = $_POST;

$fields = '';
$url = base_url(true).'/admin-user';

$data = array(
    'first_name' => urlencode($_POST['first_name']),
    'last_name' => urlencode($_POST['last_name']),
    'email' => urlencode($_POST['email']),
    'password' => urlencode($_POST['password']),
    'retype_password' => urlencode($_POST['retype_password']),
);
foreach($data as $key=>$value) { $fields .= $key.'='.$value.'&'; }
rtrim($fields, '&');

define("CODEIGNITER_EXTERNAL_ACCESS", true);
$CI = require_once('../external.php');
$result = $CI->createAdminUser($data);
die($result);

//Earlier approach e.g. via the complete-install url
/*die(hitUrl($url, $fields));
function hitUrl($url, $fields) {
    //$server_output = file_get_contents($url);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
    curl_close ($ch);
    return $server_output;
}
*/