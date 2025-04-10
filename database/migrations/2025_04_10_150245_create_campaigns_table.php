<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Association avec l'utilisateur
            $table->foreignId('newsletter_id')->constrained()->onDelete('cascade'); // Association avec la newsletter
            $table->enum('status', ['draft', 'sent', 'scheduled'])->default('draft');
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamps();
        }); 
    }
    
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
    
};
