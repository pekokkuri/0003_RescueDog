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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignID('user_id')->constrained()->onDelete('cascade');
            $table->string('type');   //comment or reply
            $table->foreignID('comment_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignID('reply_id')->nullable()->constrained()->onDelete('cascade');
            $table->boolean('is_read')->default(false);  //既読フラグ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {   
        Schema::dropIfExists('notifications');
    }
};
