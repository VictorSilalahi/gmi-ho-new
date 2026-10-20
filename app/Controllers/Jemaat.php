<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class Jemaat extends BaseController
{

    use ResponseTrait;

    public function index(): string
    {
        return view('jemaat');
    }

    public function jemaat_all()
    {

        $distrik = $this->request->getPost("distrik");

        $base_url = base_url();
        $buang = "distrik/";

        $remote_api = str_replace($buang, "", $base_url);

        $remote_api = $remote_api . "gereja/webapi/v1/distrik/jemaat/all";
        // echo($remote_api);
        $client = \Config\Services::curlrequest();

        $response = $client->request('POST', $remote_api, [
            'verify'=>false,
            'form_params' => [
                'distrik' => $distrik
            ],
            'headers' => [
                'User-Agent' => 'SIGMI/Distrik/1.0',
                'Accept'     => 'application/json'
            ]
        ]);

        // Read the body response
        $body = json_decode($response->getBody());

        // print_r($body);

        return $this->respond([
                "msg"=>"ok", 
                "data"=>$body
        ]);


    }
}
