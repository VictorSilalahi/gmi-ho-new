<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class Distrik extends BaseController
{

    use ResponseTrait;

    public function index()
    {
        return view('distrik');
        
    }




    public function terima_kasih()
    {
        return view('terima_kasih');        
    }

    public function seting()
    {
        return view('seting');
        
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }




}


