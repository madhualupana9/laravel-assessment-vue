<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->text('value')->nullable();
            $table->string('icon')->nullable();
            $table->string('status')->default('1');
            $table->string('type')->default('detail');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            
            $table->index('key');
            $table->index('user_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('details');
    }
};
