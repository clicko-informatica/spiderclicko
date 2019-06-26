<?php

namespace Clicko\SpiderClicko;

use Illuminate\Database\Eloquent\Model;

class SpiderClickoCredentials extends Model
{
    protected $table = 'spider_clicko_credentials';

    protected $fillable = [
        'user', 'pass', 'passphrase', 'access_token', 'expires_at'
    ];

    public function checkIfExpired()
    {
        $fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
        $fecha_entrada = strtotime($this->expires_at);

        if($fecha_actual > $fecha_entrada) {
            return true;
        } else{
            return false;
        }
    }
}
