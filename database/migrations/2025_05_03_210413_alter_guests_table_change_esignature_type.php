<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('guests', function (Blueprint $table) {
        $table->longText('e_signature')->change();
    });
}

public function down()
{
    Schema::table('guests', function (Blueprint $table) {
        $table->string('e_signature', 255)->change();
    });
}

};
