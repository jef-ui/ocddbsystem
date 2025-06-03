<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
        Schema::table('records', function (Blueprint $table) {
            $table->string('file_path3')->nullable()->after('file_path2');
            $table->string('file_path4')->nullable()->after('file_path3');
            $table->string('file_path5')->nullable()->after('file_path4');
            $table->string('file_path6')->nullable()->after('file_path5');
            $table->string('file_path7')->nullable()->after('file_path6');
            $table->string('file_path8')->nullable()->after('file_path7');
            $table->string('file_path9')->nullable()->after('file_path8');
        });
    }

    public function down(): void
    {
        Schema::table('records', function (Blueprint $table) {
            $table->dropColumn([
                'file_path3', 'file_path4', 'file_path5', 
                'file_path6', 'file_path7', 'file_path8', 'file_path9'
            ]);
        });
    }
};
