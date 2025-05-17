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
        Schema::create('ris_admin_cards', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('name');
            $table->string('position');
            $table->string('division');
            $table->string('office_agency');
            $table->string('unit');
            $table->string('description');
            $table->decimal('quantity', 5, 2);
            $table->decimal('amount_utilized', 8, 2);
            $table->decimal('balance', 10, 2);
            $table->unsignedInteger('invoice_number');
            $table->string('plate_number');
            $table->string('type_car');
            $table->string('purpose');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ris_admin_cards');
    }
};
