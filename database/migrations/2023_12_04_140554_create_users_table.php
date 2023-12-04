<?php

// database/migrations/xxxx_xx_xx_create_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('Users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('name');
            $table->string('password');
            $table->string('username');
            $table->string('email');
            $table->string('phone_number');
            $table->string('address');
            $table->timestamps(); // Adiciona created_at e updated_at automaticamente
        });
    }

    public function down()
    {
        Schema::dropIfExists('Users');
    }
}

