<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class Wilayah extends BaseController
{

    use ResponseTrait;

    public function index()
    {
        return view('wilayah');
        
    }

    public function validasi()
    {

        $db = \Config\Database::connect();

        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");

        $sql = "select user_id, tipe from tuser where username='".$username."' and password='".$password."'";

        $query = $db->query($sql);

        if ($query) {

            $count = $query->getNumRows();

            if ($count==1) {

                $result = $query->getRow();

                $key = getenv('jwt.encryption.key');

                $iat = time(); // Issued at time
                $exp = $iat + 7200; // Expiration time
                $isi_data = [
                    "user_id"=>$result->user_id, 
                    "tipe"=>$result->tipe
                ];

                $payload = [
                    'iat' => $iat,
                    'exp' => $exp,
                    'data' => $isi_data,
                ];

                $token = JWT::encode($payload, $key, 'HS256');

                $db->close();

                return $this->respond([
                    'status'=> 200,
                    'pesan'=>'Login sukses',
                    'token'=> $token,
                    'halaman'=>'jemaat',
                    'tipe'=>$result->tipe
                ]);

            } else {

                return $this->respond([
                    "status"=>422, 
                    "pesan"=>"Error operasi!"
                ]);

            }
        }
    }

    public function daftar()
    {
        return view('daftar');
    }


    public function cek_distrik()
    {

        $db = \Config\Database::connect();

        $distrik = $this->request->getPost("distrik");

        $query = $db->query("select count(*) as jumlah from tdistrik where distrik='".$distrik."'");
        
        if ($query) {
            $result = $query->getResultArray();
            $data = array("status"=>"ok", "judul"=>"cek keberadaan distrik", "jumlah"=>$result[0]['jumlah']);
            return $this->respond($data, 200);
        } else {
            $data = array("status"=>"error", "judul"=>"cek keberadaan distrik", "pesan"=>"Error operasi!");
            return $this->respond($data, 422);
        }


    }
    

    public function password_change()
    {

        $password_baru = $this->request->getPost("password_baru");
        $token = $this->request->getPost("token");

        try {

            $key = getenv('jwt.encryption.key');

            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            
            $distrik = $decoded->data->distrik;

            $db = \Config\Database::connect();
            $sql = "update tdistrik set password='".$password_baru."' where distrik='".$distrik."'";

            $db->query($sql);

            return $this->respond([
                    'msg'  => "ok",
                    'pesan' => 'Password berhasil diubah'
            ]);


        } catch (\Exception $e) {
            
            return $this->respond([
                    'status'  => 401,
                    'pesan' => 'Token tidak valid'
            ]);
        }

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


