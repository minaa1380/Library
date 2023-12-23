<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name' , 200);
            $table->string('family' , 250);
            $table->string('username' , 250)->unique();
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->tinyInteger('user_type')->default(0); // 0 => customer , 1 => admin
            $table->string('status' , 250)->nullable()->default(null);
            $table->date('expire_date');
            $table->string('pic')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
