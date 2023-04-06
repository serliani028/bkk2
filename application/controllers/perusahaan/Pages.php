<?php

class Pages extends CI_Controller
{
    /**
     * View Function to display home page
     *
     * @return html/string
     */
    public function index()
    {
    if (empty(PhSession())) {
        redirect('login-perusahaan');
    }else{
        redirect('perusahaan/admin');
    }
    }
}
