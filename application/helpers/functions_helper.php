<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('dd')) {
function dd($var = '') {
    echo "<pre>";
    print_r($var);
    exit;
}
}

function objToArr($obj) {
    return json_decode(json_encode($obj), true);
}

function appId() {
    return 'f89c848fa';
}

function makePassword($password)
{
    return md5($password).appId();
}

function keyedArray($array) {
    $return = array();
    foreach ($array as $v) {
        $return[$v] = '';
    }
    return $return;
}

function sel($column, $value, $text = '') {
    if (is_array($value)) {
        echo in_array($column, $value) ? 'selected' : '';
    } else {
        echo strtolower($column) == strtolower($value) ? ($text ? $text : "selected") : '';
    }
}

function selMenu($column, $value) {
    $column = strtolower($column);
    if (is_array($value)) {
        echo in_array($column, $value) ? 'active' : '';
    } else {
        echo $column == strtolower($value) ? 'class="active"' : '';
    }
}

function makeSlug($string)
{
    return preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($string)));
}

function trimString($str, $length = 20, $removeImage = true)
{
    if ($str != '') {
        if ($removeImage == true) {
            $str = preg_replace("/<img[^>]+\>/i", "", $str);
        }
        $str = preg_replace('/<h1[^>]*>([\s\S]*?)<\/h1[^>]*>/', '', $str);
        $str = preg_replace('/<h2[^>]*>([\s\S]*?)<\/h2[^>]*>/', '', $str);
        return mb_strimwidth($str, 0, $length, "...");
    } else {
        return '---';
    }
}

function sectionTitle($str)
{
    if ($str != '') {
        return ucwords($str);
    } else {
        return '---';
    }
}

function hyphenIfNull($str)
{
    if ($str == '') {
        return '---';
    }
}

function setting($index = '')
{
    return SettingsHelper::Instance($index);
}

function spammed($string, $type = 'stories')
{
    $CI = get_instance();
    $spams = objToArr($CI->SpamModel->getAll());
    $usedSpams = '';
    if ($spams && setting('check-stories-spam') == 'yes' && $type == 'stories') {
        foreach ($spams as $spam) {
            if (strpos($string, $spam['title']) !== false) {
                $usedSpams .= $spam['title'].', ';
            }
        }
    }
    if ($spams && setting('check-comments-spam') == 'yes' && $type == 'comments') {
        foreach ($spams as $spam) {
            if (strpos($string, $spam['title']) !== false) {
                $usedSpams .= $spam['title'].', ';
            }
        }
    }
    return $usedSpams;
}

function allowedTo($permission = '', $redirect = '')
{
    $CI = get_instance();
    $CI->load->library('session');
    $permissions = objToArr($CI->session->userdata('admin')['permissions']);
    if ($CI->session->userdata('admin')['user_type'] == 'admin') {
        return true;
    }
    if (is_array($permission)) {
        foreach ($permission as $value) {
            if (in_array($value, $permissions)) {
                return true;
            }
        }
    } else {
        return in_array($permission, $permissions);
    }
}

function candidateSession($field = '')
{
    $CI = get_instance();
    $CI->load->library('session');
    if (isset($CI->session->userdata('candidate')['candidate_id']) && $field == '') {
        return $CI->session->userdata('candidate')['candidate_id'];
    } else if (isset($CI->session->userdata('candidate')[$field])) {
        return $CI->session->userdata('candidate')[$field];
    }
}

function adminSession($field = '')
{
    $CI = get_instance();
    $CI->load->library('session');
    if (isset($CI->session->userdata('admin')['user_id']) && $field == '') {
        return $CI->session->userdata('admin')['user_id'];
    } else if (isset($CI->session->userdata('admin')[$field])) {
        return $CI->session->userdata('admin')[$field];
    }
}

function PhSession($field = '')
{
    $CI = get_instance();
    $CI->load->library('session');
    if (isset($CI->session->userdata('company')['company_id']) && $field == '') {
        return $CI->session->userdata('company')['company_id'];
    } else if (isset($CI->session->userdata('company')[$field])) {
        return $CI->session->userdata('company')[$field];
    }
}


function getTextFromFile($file)
{
    $file = ASSET_ROOT.'/data/'.$file;
    $fh = fopen($file, 'r');
    $pageText = fread($fh, 25000);
    return $pageText;
}

function imageDimensions() {
    return array(
        array('1620', '800'),
        array('1070', '604'),
        array('828', '468'),
        //array('500', '300'),
        array('366', '219'),
        array('360', '220'),
        array('330', '180'),
        array('320', '200'),
        array('180', '160'),
        //array('160', '120'),
    );
}

function userImageDimensions() {
    return array(
        array('60', '60'),
        array('12', '120'),
    );
}

function imageThumb($image, $width, $height, $title = '', $class = '', $param = '') {
    $image = explode('.', $image);
    $image = $image[0].'-'.$width.'-'.$height.'.'.$image[1];
    $image = base_url().'assets/images/stories/'.$image;
    $imageNotFound = 'image-not-found-'.$width.'-'.$height.'.png';
    $notFound = base_url().'assets/images/'.$imageNotFound;
    $onError = 'onerror="this.src=\''.$notFound.'\'"';
    return '<img class="'.$class.'" src="'.$image.'" alt="'.$title.'" title="'.$title.'" '.$onError.' '.$param.'/>';
}

function departmentThumb($image, $width = '', $height = '') {
    if (strpos($image, 'http') !== false) {
        return $image;
    }
    if ($width == '' && $image) {
        $image = base_url().'assets/images/departments/'.$image;
        return $image;
    }
    $image = explode('.', $image);
    if (isset($image[0]) && isset($image[1])) {
        $image = $image[0].'-'.$width.'-'.$height.'.'.$image[1];
        $image = base_url().'assets/images/departments/'.$image;
        return $image;
    }
}

function questionThumb($image, $width = '', $height = '') {
    if (strpos($image, 'http') !== false) {
        return $image;
    }
    if ($width == '' && $image) {
        $image = base_url().'assets/images/questions/'.$image;
        return $image;
    }
    $image = explode('.', $image);
    if (isset($image[0]) && isset($image[1])) {
        $image = $image[0].'-'.$width.'-'.$height.'.'.$image[1];
        $image = base_url().'assets/images/questions/'.$image;
        return $image;
    }
}

function questionThumb2($image) {
    return ASSET_ROOT.'/images/questions/'.$image;
}

function userThumb($image, $width = '', $height = '') {
    if (strpos($image, 'http') !== false) {
        return $image;
    }
    if ($width == '' && $image) {
        $image = base_url().'assets/images/users/'.$image;
        return $image;
    }
    $image = explode('.', $image);
    if (isset($image[0]) && isset($image[1])) {
        $image = $image[0].'-'.$width.'-'.$height.'.'.$image[1];
        $image = base_url().'assets/images/users/'.$image;
        return $image;
    }
}

function candidateThumb($image, $width = '', $height = '') {
    if (strpos($image, 'http') !== false) {
        return $image;
    }
    if ($width == '' && $image) {
        $image = base_url().'assets/images/candidates/'.$image;
        return $image;
    }
    $image = explode('.', $image);
    if (isset($image[0]) && isset($image[1])) {
        $image = $image[0].'-'.$width.'-'.$height.'.'.$image[1];
        $image = base_url().'assets/images/candidates/'.$image;
        return $image;
    }
}

function candidateThumb2($image, $width = '', $height = '') {
    if ($image) {
        $image = ASSET_ROOT.'/images/candidates/'.$image;
    } else {
        $image = ASSET_ROOT.'/images/candidates/not-found.png';
    }
    return $image;
}

function notFoundAvatar() {
    $image = base_url().'assets/images/not-found.png';
    return $image;
}

function encode($id) {
    return encodeDecodeFunction($id, 'e');
}

function decode($id) {
    return encodeDecodeFunction($id, 'd');
}

function encodeDecodeFunction( $string, $action = 'e' ) {
    $secret_key = appId();
    $secret_iv = 'my_simple_secret_iv';

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }

    return $output;
}

function timeFormat($time = '') {
    $format = 'd M, Y h:i A';
    $time = $time != '' ? $time : date('Y-m-d G:i:s');
    return date($format, strtotime($time));
}

function dateFormat($time = '') {
    $format = 'd M, Y';
    $time = $time != '' ? $time : date('Y-m-d G:i:s');
    return date($format, strtotime($time));
}

function divisibleArray($number) {
    if ($number == '3') {
        return array(3,6,9,12,15,18,21,24,27,30);
    } else {
        return array(4,8,12,16,20,24,28,32,36,40);
    }
}

function token()
{
    return base64_encode(date('Y-m-d G:i:s')) . appId();
}

function activeItem($type, $slug)
{
    $path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
    $exploded = explode('/', $path);
    $match = '';
    if (isset($exploded[1]) && isset($exploded[2])) {
        if ($exploded[1] == $type && $exploded[2] == $slug) {
            $match = 'active';
        }
    } elseif (isset($exploded[1]) && !isset($exploded[2]) && $exploded[1] == $slug) {
        $match = 'active';
    }
    echo $match;
}

function getIds($array, $key, $string = false)
{
    $ids = array();
    foreach ($array as $a) {
        $ids[] = $a[$key];
    }
    return $string ? implode(',', $ids) : $ids;
}

function adminUnreadMessagesCount()
{
    $CI = get_instance();
    return $CI->MessageModel->adminUnreadMessagesCount();
}

function footer($column = 'First Column')
{
    $controllerInstance = & get_instance();
    return $controllerInstance->footer($column);
}

function checkFooterColumns($data)
{
    $count = 0;
    foreach ($data as $k => $d) {
        if (!empty($d)) {
            $count = $count + 1;
        }
    }
    if ($count == 1 || $count == 2) {
        $count = 6;
    } elseif ($count == 3) {
        $count = 4;
    } elseif ($count == 4) {
        $count = 3;
    }
    return $count;
}

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function getClientIpAddress() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function hideApiFields($type) {
    if (SS_DEMO) {
        $array = array(
            'paypal-email',
            'stripe-key',
            'stripe-secret',
            'google-client-id',
            'google-client-secret',
            'facebook-app-id',
            'facebook-app-secret',
            'sendgrid-username',
            'sendgrid-password',
            'share-script',
            'share-tag'
        );
        if (in_array($type, $array)) {
            return 'password';
        }
    }
    return 'text';
}

function acActive($val1, $val2)
{
    return $val1 == $val2 ? 'class="active"' : '';
}

function dateOnly($date)
{
    return date('Y-m-d', strtotime($date));
}

function arrangeSections($data)
{
    $return = array();
    $keys = array();
    foreach ($data as $key => $value) {
        $keys[] = $key;
    }
    for ($i=0; $i < count(array_values($data)[0]) ; $i++) {
        foreach ($keys as $key) {
            $return[$i][$key] = $data[$key][$i];
        }
    }
    return $return;
}

function sortForCSV($data)
{
    $return = array();
    $keys = array_keys($data[0]);
    for ($i=0; $i < count($data) ; $i++) {
        foreach ($keys as $key) {
            $return[$i][] = $data[$i][$key];
        }
    }
    $return = array_merge(array($keys), $return);
    return $return;
}

function jobsCheckboxSel($data, $val)
{
    echo in_array($val, explode(',', $data)) ? 'checked ' : '';
}

function jobStatus($status, $level)
{
    $res = '';
    if ($status == 'hired' && ($level == 1 || $level == 2 || $level == 3 || $level == 4)) {
        $res = 'complete';
    } elseif (($status == 'interviewed' || $status == 'INTERVIEW TAHAP 2' )&& ($level == 1 || $level == 2 || $level == 3)) {
        $res = 'complete';
    } elseif ($status == 'shortlisted' && ($level == 1 || $level == 2)) {
        $res = 'complete';
    } elseif ($status == 'applied' && $level == 1) {
        $res = 'complete';
    } else {
        $res = 'disabled';
    }
    echo $res;
}

function quizTime($from = null, $to = null) {
    //Current Time
    if($from != null){
    $now = date('Y-m-d G:i:s');

    //Max time
    $minutes_to_add = $to;
    $time = new DateTime($from);
    $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
    $max = $time->format('Y-m-d G:i:s');

    //Difference
    $diff = strtotime($max) - strtotime($now);

    return array(
        'now' => $now,
        'max' => $max,
        'diff' => $diff,
        'clock' => gmdate("H:i:s", $diff)
    );
    }

}

function textToImage($txt, $user) {
    $images = '';
    $txt = wordwrap($txt,80,"--(|)--");
    $txts = explode('--(|)--', $txt);
    foreach ($txts as $k => $txt) {
        $img = imagecreate(800, 35);
        $textbgcolor = imagecolorallocate($img, 255, 255, 255);
        $textcolor = imagecolorallocate($img, 0, 0, 0);
        $txt = $txt;
        imagestring($img, 10, 10, 10, $txt, $textcolor);
        ob_start();
        imagepng($img);
        $base64 = base64_encode(ob_get_clean());
        $name = ($k+1).'-'.$user.'-question.jpeg';
        $file = ASSET_ROOT.'/images/questions/'.$name;
        $image = base64_to_jpeg($base64, $file);
        $images .= '<img src="'.base_url().'assets/images/questions/'.$name.'" width="100%"/><br />';
    }
    return $images;
}

function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function base64_to_jpeg($base64_string, $output_file) {
    $ifp = fopen( $output_file, 'wb' );
    fwrite($ifp, base64_decode($base64_string));
    fclose($ifp);
    return $output_file;
}

function getMonthsBetweenDates($date1, $date2) {
    $ts1 = strtotime($date1);
    $ts2 = strtotime($date2);
    $year1 = date('Y', $ts1);
    $year2 = date('Y', $ts2);
    $month1 = date('m', $ts1);
    $month2 = date('m', $ts2);
    $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
    return $diff;
}

function getExprienceInMonths($data)
{
    $experience = 0;
    foreach ($data as $key => $value) {
        $experience = $experience + getMonthsBetweenDates($value['from'], $value['to']) + 1;
    }
    return $experience;
}

function checkQuizCorrect($answer, $original, $type)
{
    if ($type == 'radio') {
      return $answer == $original ? 'answer' : '';
    } else {
      if (is_array($answer)) {
        foreach ($answer as $value) {
          if ($value == $original) {
            return 'answer';
          }
        }
      }
    }
}

function columnCount($columns)
{
    $count = count($columns);
    if ($count == 4) {
        return 3;
    } else if ($count == 3) {
        return 4;
    } else if ($count == 2) {
        return 6;
    } else if ($count == 1) {
        return 12;
    }
}

function footerColumns()
{
    $CI = get_instance();
    $footer['columns'] = $CI->AdminFooterSectionModel->getAll('columns');
    $footer['column_count'] = columnCount($footer['columns']);
    return $footer;
}

function arrayToString($array)
{
    $lang = '<?php '.PHP_EOL.PHP_EOL;
    foreach ($array as $key => $value) {
        $lang .= '$lang["'.$key.'"] = "'.htmlspecialchars($value).'";'.PHP_EOL;
    }
    return $lang;
}

function arrayToStringJs($array)
{
    $jsVars = array(
        "candidates",
        "click_to_activate",
        "click_to_deactivate",
        "are_u_sure",
        "please_select_some_records_first",
        "edit_blog_category",
        "create_blog_category",
        "candidate_interview",
        "edit_company",
        "create_company",
        "edit_to_do_item",
        "create_to_do_item",
        "edit_department",
        "create_department",
        "edit_interview",
        "create_interview",
        "clone_interview",
        "edit_interview_category",
        "create_interview_category",
        "edit_interview_question",
        "create_interview_question",
        "create_language",
        "edit_question",
        "create_question",
        "change_to_multi_correct",
        "change_to_single_correct",
        "edit_question_category",
        "create_question_category",
        "edit_quiz",
        "create_quiz",
        "clone_quiz",
        "edit_quiz_category",
        "create_quiz_category",
        "edit_quiz_question",
        "create_quiz_question",
        "edit_trait",
        "create_trait",
        "edit_user",
        "create_user",
        "edit_language",
        "mark_favorite",
        "unmark_favorite",
        "refer_this_job",
        "inactive",
        "active",
        "only_1_candidate_allowed",
        "only_3_candidates_allowed",
        "only_5_candidates_allowed",
        "only_10_candidates_allowed",
    );
    $lang = 'var lang = []; '.PHP_EOL.PHP_EOL;
    foreach ($array as $key => $value) {
        if (in_array($key, $jsVars)) {
            $lang .= 'lang["'.$key.'"] = "'.htmlspecialchars($value).'";'.PHP_EOL;
        }
    }
    return $lang;
}

function esc_output($string, $type = 'attr')
{
    if ($type == 'raw') {
        return $string;
    }
    return html_escape($string);
}

function remoteRequest($url = '')
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}

function createFile($file, $data)
{
    try {
        $file = MAIN_ROOT.'/'.$file;
        $file = fopen($file, "w");
        fwrite($file, $data);
        fclose($file);
        return 'success';
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function encryptLargeString($plainText)
{
    $technique = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($technique);
    $options = 0;
    $encryption_iv = 'U{W>f}86-]%q,kK:';
    $encryption_key = "LJnt&kpj=]~~~b8e";
    $encryption = openssl_encrypt($plainText, $technique, $encryption_key, $options, $encryption_iv);
    return $encryption;
}

function decryptLargeString($encryptedText)
{
    $technique = "AES-128-CTR";
    $decryption_key = "LJnt&kpj=]~~~b8e";
    $options = 0;
    $decryption_iv = 'U{W>f}86-]%q,kK:';
    $decryption = openssl_decrypt ($encryptedText, $technique,  $decryption_key, $options, $decryption_iv);
    return $decryption;
}
