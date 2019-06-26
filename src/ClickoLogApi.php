<?php

namespace Clicko\SpiderClicko;

use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Client;

class ClickoLogApi
{
    public function __construct(){
        $this->client = new Client();
    }

    public function register($user, $pass, $passphrase)
    {
        try {
            $response = $this->client->request('POST', 'http://logger.clicko.es/api/auth/signup', [
                'headers' => [
                    "Accept" => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    "nombre" => $user,
                    "password" => $pass,
                    "url" => url('/'),
                    "phrasepass" => $passphrase,
                ]
            ]);
        } catch (TransferException $e) {
            if ($e->hasResponse()) {
                logger($e->getMessage());
            }
        }

        return \GuzzleHttp\json_decode($response->getBody()->getContents());
    }

    public function getToken($user, $pass, $passphrase)
    {
        try {
            $response = $this->client->request('POST', 'http://logger.clicko.es/api/auth/login', [
                'headers' => [
                    "Accept" => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    "nombre" => $user,
                    "password" => $pass,
                    "phrasepass" => $passphrase,
                ]
            ]);
        } catch (TransferException $e) {
            if ($e->hasResponse()) {
                logger(json_encode($e));
            }
        }

        return \GuzzleHttp\json_decode($response->getBody()->getContents());
    }

    public function saveLog($log, $accesToken)
    {
        try {
            $response = $this->client->request('POST', 'http://logger.clicko.es/api/auth/log/save', [
                'headers' => [
                    "Accept" => 'application/x-www-form-urlencoded',
                    "Authorization" => 'Bearer '.$accesToken,
                ],
                'form_params' => $log
            ]);
        } catch (TransferException $e) {
            if ($e->hasResponse()) {
                logger(json_encode($e));
            }
        }

        return \GuzzleHttp\json_decode($response->getBody()->getContents());
    }
}
