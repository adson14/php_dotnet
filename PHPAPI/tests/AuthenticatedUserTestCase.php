<?php


namespace Tests;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

abstract class AuthenticatedUserTestCase extends TestCase
{

    protected $token;
/*
    public function __construct($name = null, array $data = [], $dataName = '')
    {
       // parent::__construct($name, $data, $dataName);
        $this->token();
    }*/

    protected function token(): void
    {

        $user = factory(\App\User::class)->create();

        $credentials = $user->only(['email', 'password']);
        $credentials['password'] = 'adson1415';

       // if (!$this->token = auth('api')->attempt($credentials)) {
//    //        return response()->json(['error' => 'Unauthorized'], 401);
        //}


        $this->token = JWTAuth::fromUser($user);

        JWTAuth::setToken($this->token);

        Auth::login($user);
    }

    protected function callRoute($method, $route, $data = [], $headers = [])
    {
        $this->token();

        if ($this->token && !isset($headers['Authorization'])) {
            $headers['HTTP_Authorization'] = "Bearer: $this->token";
        }

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer {$this->token}"
        ];

        $client = new Client([
            'headers' => $headers
        ]);

        return $client->request($method, $route, [
            'body' => json_encode($data)
        ]);







/*
        return $this->call(
            $method,
            $route,
            [],
            [],
            [],
           [],
            json_encode($data)
        );*/
    }
}
