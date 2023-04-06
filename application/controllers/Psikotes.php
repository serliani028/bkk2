<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

class Psikotes extends CI_Controller{
    
    public function cek_generateKode(){
        $generatedcode = $this->Psikotes_Model->generate_kodeAktivasi('Modul Test 1');
        
        var_dump($generatedcode);
        
    }
}