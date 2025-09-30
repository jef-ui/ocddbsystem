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
        Schema::create('ldrrmos', function (Blueprint $table) {
            $table->id();
            $table->string('agency_name');  // Name of the agency
            $table->string('head_name');  // Head of the agency
            $table->string('office_address');  // Address of the office
            $table->string('contact_number');  // Primary contact number
            $table->string('alt_contact_number')->nullable();  // Nullable alternative contact number
            $table->string('official_email_add');  // Official email address
            $table->string('alt_email_add')->nullable();  // Nullable alternative email address
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ldrrmos');
    }
};
