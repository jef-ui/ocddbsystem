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
        Schema::create('trainingdbs', function (Blueprint $table) {
            $table->id();
            $table->string('training_title');
            $table->string('ims_number');
            $table->string('training_type');
            $table->string('province');
            $table->string('municipality');
            $table->string('sector');
            $table->date('date_from');
            $table->date('date_until');
            $table->string('venue');
            $table->decimal('number_graduates',8,2);
            $table->decimal('number_participation',8,2)->nullable();
            $table->string('funding');
            $table->string('ocd_personnel');
            $table->string('file_path')->nullable();
            $table->string('file_path1')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainingdbs');
    }
};
