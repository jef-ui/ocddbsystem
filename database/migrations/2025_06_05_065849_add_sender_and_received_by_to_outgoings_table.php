<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('outgoings', function (Blueprint $table) {
        $table->string('sender')->nullable()->after('recipient');
        $table->string('received_by')->nullable()->after('sender');
    });
}

public function down(): void
{
    Schema::table('outgoings', function (Blueprint $table) {
        $table->dropColumn(['sender', 'received_by']);
    });
}

};
