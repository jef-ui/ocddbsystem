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
        Schema::create('radio_logs', function (Blueprint $table) {
            $table->id();
            $table->date('received_date');
            $table->time('received_time');
            $table->string('sender_name')->nullable();
            $table->string('band');
            $table->string('mode');
            $table->string('signal_strength');
            $table->string('receiver_name')->nullable();
            $table->string('notes_remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('radio_logs');
    }
};
