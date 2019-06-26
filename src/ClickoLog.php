<?php

namespace Clicko\SpiderClicko;

class ClickoLog
{
    private $accesToken;

    public function register($user, $pass, $phrasepass)
    {
        $clickoLogApi = new ClickoLogApi();

        $token = $clickoLogApi->register($user, $pass, $phrasepass);

        if ($token->message=="Incorrect PassPhrase!"){
            return $token->message;
        } else{
            $spiderClickoCredentials = new SpiderClickoCredentials();

            $spiderClickoCredentials->user = $user;
            $spiderClickoCredentials->pass = $pass;
            $spiderClickoCredentials->passphrase = $phrasepass;
            $spiderClickoCredentials->access_token = $token->access_token;
            $spiderClickoCredentials->expires_at = $token->expires_at;

            if ($spiderClickoCredentials->save())
                return 'Token guardado en la base de datos. La url es: '.url('/');
            else
                return 'Error al Guardar el Token.';
        }
    }

    static function saveLog($exception){
        $spiderClickoCredentials = SpiderClickoCredentials::first();
        $clickoLogApi = new ClickoLogApi();

        if ($spiderClickoCredentials->checkIfExpired()){
            $token = $clickoLogApi->getToken($spiderClickoCredentials->user, $spiderClickoCredentials->pass, $spiderClickoCredentials->passphrase);

            $spiderClickoCredentials->access_token = $token->access_token;
            $spiderClickoCredentials->expires_at = $token->expires_at;
            $spiderClickoCredentials->save();
        }

        $user= \Auth::check() ? \Auth::user()->id : null;
        $payload= json_encode([
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTraceAsString(),
        ]);

        if (!$clickoLogApi->saveLog(['user' => $user, 'payload' => $payload, 'type' => 'Exception' ], $spiderClickoCredentials->access_token)){
            logger('Error al guardar el Clicko Log.');
        }
    }
}
