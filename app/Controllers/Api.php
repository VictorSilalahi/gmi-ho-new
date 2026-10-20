<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Api extends BaseController
{
    use ResponseTrait;
    
    public function periksa_token()
    {

        $authHeader = $this->request->getServer('HTTP_AUTHORIZATION');

        if (!$authHeader) {
            // Alternative fetch method for some apache environments
            $authHeader = $this->request->getHeaderLine('Authorization');
        }

        // Pemisahan Bearer
        if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            
            $token = $matches[1];
            
        } else {

            return $this->respond([
                    'status'  => 401,
                    'pesan' => 'Token tidak ada'
            ]);
        }

        try {

            $key = getenv('jwt.encryption.key');
            // Decode the token using firebase/php-jwt (v6+ syntax)
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            
            // Optional: Pass the decoded payload data into the request object for use in controllers
            return $this->respond([
                    'status'  => 200,
                    'data' => $decoded
            ]);

        } catch (Exception $e) {

            return $this->respond([
                    'status'  => 401,
                    'pesan' => 'Token tidak valid'
            ]);

        }        

    }
}
