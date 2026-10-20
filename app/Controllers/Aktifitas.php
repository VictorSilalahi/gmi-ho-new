<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class Aktifitas extends BaseController
{

    use ResponseTrait;

    public function index(): string
    {
        return view('aktifitas');
    }

    public function aktifitas_all()
    {

        $distrik = $this->request->getPost("distrik");
        $masa_waktu = $this->request->getPost("waktu");

        $base_url = base_url();
        $buang = "distrik/";

        $remote_api = str_replace($buang, "", $base_url);

        $remote_api = $remote_api . "gereja/webapi/v1/distrik/gereja/aktifitas/all";
        // echo($remote_api);
        $client = \Config\Services::curlrequest();

        $response = $client->request('POST', $remote_api, [
            'verify'=>false,
            'form_params' => [
                'distrik' => $distrik,
                'bulan_mundur'=>$masa_waktu
            ],
            'headers' => [
                'User-Agent' => 'SIGMI/Distrik/1.0',
                'Accept'     => 'application/json'
            ]
        ]);

        // Read the body response
        $body = json_decode($response->getBody());

        return $this->respond([
                "msg"=>"ok", 
                "data"=>$body
        ]);



    }
}
