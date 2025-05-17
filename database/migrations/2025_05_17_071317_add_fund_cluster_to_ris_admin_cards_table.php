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
    Schema::table('ris_admin_cards', function (Blueprint $table) {
        $table->string('fund_cluster')->nullable();
    });
}


    public function down()
{
    Schema::table('ris_admin_cards', function (Blueprint $table) {
        $table->dropColumn('fund_cluster');
    });
}
};
