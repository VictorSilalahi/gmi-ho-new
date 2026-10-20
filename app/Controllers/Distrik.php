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

    public function validasi()
    {

        $db = \Config\Database::connect();

        $distrik = $this->request->getPost("distrik");
        $password = $this->request->getPost("password");

        $sql = "select distrik, email from tdistrik where distrik='".$distrik."' and password='".$password."'";

        $query = $db->query($sql);

        if ($query) {

            $count = $query->getNumRows();

            if ($count==1) {

                $result = $query->getRow();

                $key = getenv('jwt.encryption.key');

                $iat = time(); // Issued at time
                $exp = $iat + 7200; // Expiration time
                $isi_data = [
                    "distrik"=>$result->distrik, 
                    "email"=>$result->email
                ];

                $payload = [
                    'iat' => $iat,
                    'exp' => $exp,
                    'data' => $isi_data,
                    'email' => $result->email
                ];

                $token = JWT::encode($payload, $key, 'HS256');

                $db->close();

                return $this->respond([
                    'status'=> 200,
                    'pesan'=>'Login sukses',
                    'token'=> $token,
                    'distrik'=>$result->distrik
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


    function get_info_distrik()
    {

        $data = array();

        $token = $this->request->getPost("token");

        try {


            $key = getenv('jwt.encryption.key');

            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            
            $distrik = $decoded->data->distrik;

            $db = \Config\Database::connect();

            $sql = "select alamat, kabupaten_id from tdistrik where distrik='".$distrik."'";

            $query = $db->query($sql);

            $result = $query->getRow();

            $data['alamat'] = $result->alamat;
            $data['kabupaten_id'] = $result->kabupaten_id;
            $data['distrik'] = $distrik;

            $sql = "select provinsi_id from tkabupaten where kabupaten_id=".$result->kabupaten_id;

            $query = $db->query($sql);

            $result = $query->getRow();

            $data['provinsi_id'] = $result->provinsi_id;


            return $this->respond([
                    'msg'  => "ok",
                    'pesan' => $data
            ]);

            

        } catch (\Exception $e) {
            
            return $this->respond([
                    'status'  => 401,
                    'pesan' => $e->getMessage()
            ]);


        }

    }

    
    public function cek_email()
    {

        $db = \Config\Database::connect();

        $jenis = $this->request->getPost("jenis");
        $email = $this->request->getPost("email");

        if ($jenis=='distrik') {

            $query = $db->query("select count(*) as jumlah from tdistrik where email='".$email."'");
    
        }
        
        if ($query) {
            $result = $query->getResultArray();
            $data = array("status"=>"ok", "judul"=>"cek keberadaan email", "jumlah"=>$result[0]['jumlah']);
            return $this->respond($data, 200);
        } else {
            $data = array("status"=>"error", "judul"=>"cek keberadaan email", "pesan"=>"Error operasi!");
            return $this->respond($data, 422);
        }


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
    
    public function tambah_distrik()
    {

        $db = \Config\Database::connect();

        $now = Time::now(); 

        $distrik = $this->request->getPost("slcDistrik");
        $password = $this->request->getPost("txtPassword1");
        $email = $this->request->getPost("txtEmailDistrik");
        $alamat = $this->request->getPost("txtAlamat");
        $kabupaten_id = $this->request->getPost("slcKabKota");
        $tanggal_terdaftar = Time::now(); 

        $sql = "insert into tdistrik (distrik, password, email, alamat, kabupaten_id, tanggal_terdaftar) values ('".$distrik."','".$password."','".$email."','".$alamat."',".$kabupaten_id.",'".$tanggal_terdaftar."')";

        $db->query($sql);

        $db->close();

        // kirim email pemberitahuan ke email distrik
        try {

            $this->kirim_email($distrik, $email, $password);
            return redirect()->to('daftar/terima_kasih');

        } catch (\Exception $e) {
            
            // Standard exceptions
            log_message('error', $e->getMessage());
        
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


    public function simpan_alamat_distrik()
    {

        $alamat_distrik = $this->request->getPost("alamat_distrik");
        $token = $this->request->getPost("token");

        $key = getenv('jwt.encryption.key');

        $decoded = JWT::decode($token, new Key($key, 'HS256'));
            
        $distrik = $decoded->data->distrik;

        try {

            $db = \Config\Database::connect();

            $sql = "update tdistrik set alamat='".$alamat_distrik."' where distrik='".$distrik."'";

            $db->query($sql);
            
            return $this->respond([
                'msg'  => "ok",
                'pesan' => "update alamat distrik"
            ]);


        } catch(\Exception $e) {

            return $this->respond([
                    'status'  => 401,
                    'pesan' => 'Token tidak valid'
            ]);

        }

    }


    public function simpan_kabkota_distrik()
    {

        $kabkota_id = $this->request->getPost("kabkota_id");
        $token = $this->request->getPost("token");
        
        $key = getenv('jwt.encryption.key');

        $decoded = JWT::decode($token, new Key($key, 'HS256'));
            
        $distrik = $decoded->data->distrik;

        try {

            $db = \Config\Database::connect();

            $sql = "update tdistrik set kabupaten_id=".$kabkota_id." where distrik='".$distrik."'";

            $db->query($sql);
            
            return $this->respond([
                'msg'  => "ok",
                'pesan' => "update kabupaten/kota distrik"
            ]);


        } catch(\Exception $e) {

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


    public function kirim_email($distrik, $email_to, $pwd)
    {

        $email = \Config\Services::email();

        $pengirim = getenv('email.SMTPUser');

        $email->setFrom($pengirim, "Riset & Pengembangan | GMI Wil-I");
        $email->setTo($email_to);
        $email->setSubject('Status Pendaftaran Distrik GMI Wil-I');

        $message = '<!DOCTYPE html>';
        $message = $message . '<html lang="en">';
        $message = $message . '<head>';
        $message = $message . '<meta charset="UTF-8">';
        $message = $message . '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        $message = $message . '<title>Research and Development GMI Wil-I</title>';
        $message = $message . '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">';
        $message = $message . '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">';
        $message = $message . '</head>';
        $message = $message . '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>';
        $message = $message . '<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>';
        $message = $message . '<body>';
        $message = $message . '<div class="container-fluid">';
        $message = $message . '     <div class="row">';
        $message = $message . '         <div class="col-4"></div>';
        $message = $message . '         <div class="col-4">';
        $message = $message . '             <p><h2>Proses Pendaftaran telah selesai.</h2></p>';
        $message = $message . '             <p>Anda dapat melakukan login ke aplikasi dengan menggunakan keterangan di bawah ini:</p>';
        $message = $message . '             <hr>';
        $message = $message . '             <p>Link: '.base_url().'</p>';
        $message = $message . '             <p>Distrik: ' .$distrik. '</p>';
        $message = $message . '             <p>Password: ' .$pwd. '</p>';
        $message = $message . '             <hr>';
        $message = $message . '             <p>Catatan: password dapat di ubah di dalam aplikasi melalui menu Seting > Password</p>';
        $message = $message . '         </div>';    
        $message = $message . '         <div class="col-4"></div>';
        $message = $message . '     </div>';
        $message = $message . '</div>';
        $message = $message . '</body>';
        $message = $message . '</html>';

        $email->setMessage($message);
        $email->setMailType('html');  


        if ($email->send()) {

            // return view('terima_kasih');    
            return redirect()->to('terima_kasih');

        } else {

            log_message('error', $this->email->print_debugger());
    
        }


    }

}


