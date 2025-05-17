<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::table('ris_admin_cards', function (Blueprint $table) {
        $table->string('file_path')->nullable()->after('purpose'); // place it after 'purpose' column
    });
}

public function down()
{
    Schema::table('ris_admin_cards', function (Blueprint $table) {
        $table->dropColumn('file_path');
    });
}

};
