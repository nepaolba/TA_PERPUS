<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Akun extends CI_Controller
{

    public function index()
    {
        $data = [
            'breadcrumb' => "Akun",
            'data' => "",
            'js' => 'akun.js'
        ];

        $this->viewAdmin('akun/index', $data);
    }
}

/* End of file Akun.php */
