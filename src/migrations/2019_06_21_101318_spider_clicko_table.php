<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpiderClickoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spider_clicko_credentials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user');
            $table->string('pass');
            $table->string('passphrase');
            $table->mediumText('access_token');
            $table->timestamp('expires_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spider_clicko_credentials');
    }
}
