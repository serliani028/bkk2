<?php

class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        $ci->load->helper('language');
        
        if ($ci->db->table_exists('languages')) {
            $language = objToArr($ci->AdminLanguageModel->getSelected());    
        } else {
            $language = 'english';
        }

        $ci->lang->load('message',$language);
    }
}