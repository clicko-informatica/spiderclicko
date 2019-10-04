<?php

namespace Clicko\SpiderClicko;

class ClickoLog
{
    public function register($user, $pass, $passphrase)
    {
        $clickoLogApi = new ClickoLogApi();

        $token = $clickoLogApi->register($user, $pass, $passphrase);

        if ($token->message=="Incorrect PassPhrase!"){
            return $token->message;
        } else{
            $spiderClickoCredentials = new SpiderClickoCredentials();

            $spiderClickoCredentials->user = $user;
            $spiderClickoCredentials->pass = $pass;
            $spiderClickoCredentials->passphrase = $passphrase;
            $spiderClickoCredentials->access_token = $token->access_token;
            $spiderClickoCredentials->expires_at = $token->expires_at;

            if ($spiderClickoCredentials->save())
                return 'Token guardado en la base de datos. La url es: '.url('/');
            else
                return 'Error al Guardar el Token.';
        }
    }

    private static function saveLog($payload, $type){
        $spiderClickoCredentials = SpiderClickoCredentials::first();
        $clickoLogApi = new ClickoLogApi();

        if ($spiderClickoCredentials->checkIfExpired()){
            $token = $clickoLogApi->getToken($spiderClickoCredentials->user, $spiderClickoCredentials->pass, $spiderClickoCredentials->passphrase);

            $spiderClickoCredentials->access_token = $token->access_token;
            $spiderClickoCredentials->expires_at = $token->expires_at;
            $spiderClickoCredentials->save();
        }

        $user= $spiderClickoCredentials->getNameUser();

        if (!$clickoLogApi->saveLog(['user' => $user, 'payload' => $payload, 'type' => $type], $spiderClickoCredentials->access_token)){
            logger('Error al guardar el Clicko Log.');
        }
    }

    static function exception($exception){
        $payload= json_encode([
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTraceAsString(),
        ]);

        self::saveLog($payload, 'Exception');
    }

    static function error($message){
        $payload= json_encode([
            'message' => $message,
        ]);

        self::saveLog($payload, 'Error');
    }

    static function info($message){
        $payload= json_encode([
            'message' => $message,
        ]);

        self::saveLog($payload, 'Info');
    }

    static function notice($message){
        $payload= json_encode([
            'message' => $message,
        ]);

        self::saveLog($payload, 'Notice');
    }

    static function success($message){
        $payload= json_encode([
            'message' => $message,
        ]);

        self::saveLog($payload, 'Success');
    }
}
