<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class Gereja extends BaseController
{

    use ResponseTrait;

    public function index()
    {
        return view('gereja_stat');
    }

    public function stat()
    {
        return view('gereja_stat');
    }

    public function resort()
    {
        return view('gereja_resort');
    }

    public function pemetaan()
    {
        return view('gereja_pemetaan');
    }

    public function seting()
    {
        return view('seting');
    }


    public function gereja_all()
    {

        $distrik = $this->request->getPost("distrik");

        $base_url = base_url();
        $buang = "distrik/";

        $remote_api = str_replace($buang, "", $base_url);

        $remote_api = $remote_api . "gereja/webapi/v1/distrik/gereja/all";
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

        return $this->respond([
                "msg"=>"ok", 
                "data"=>$body
        ]);

    }


    public function resort_all()
    {

        $distrik = $this->request->getPost("distrik");

        $sql = "select distrik_id from tdistrik where distrik='".$distrik."'";

        $query = $db->query($sql);



    }


    public function resort_tambah_anggota() 
    {

        $resort_id = $this->request->getPost("resort_id");

        $daftar = $this->request->getPost("daftar_di_resort");

        foreach($daftar as $d) {

            $sql = "delete from tanggotaresort where anggotaresort_id=".$d->anggotaresort_id;
            

        }


    }


    
}
