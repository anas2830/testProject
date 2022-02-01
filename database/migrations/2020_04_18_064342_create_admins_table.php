<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('photo_name')->nullable();
            $table->string('photo_original_name')->nullable();
            $table->string('photo_size')->nullable();
            $table->string('photo_extention')->nullable();
            $table->boolean('is_super')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('admins')->insert(
            array(
                'id'=> 1, 
                'name'=> 'Admin', 
                'email'=> 'admin@gmail.com', 
                'photo_name' => null, 
                'photo_original_name' => null, 
                'photo_size' => null, 
                'photo_extention' => null, 
                'is_super'=> 1, 
                'password'=> '$2y$10$bLp6tNqD5pFa78OnLPW1rua9wzGU8njGjjFVE9IyqTIth213pvMJK',
                'remember_token'=> null, 
                'created_at'=> '2020-10-14 17:38:27', 
                'updated_at'=> '2020-10-14 17:38:27'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
