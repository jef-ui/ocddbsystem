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
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->date('received_date'); // Received date
            $table->time('received_time'); // Received time
            $table->string('received_via'); //, ['email', 'fax', 'mail', 'lbc', 'jnt', 'jrsm_hand_carried', 'yahoomail', 'gmail']); // Received via
            $table->string('from_agency_office'); // From Agency/Office
            $table->string('type'); //['Request', 'Invitation', 'Submission', 'For Information', 'For Compliance', 'Report', 'Complaint']); // Type
            $table->text('subject_description'); // Subject / Description of Communication
            $table->string('received_acknowledge_by'); // Received Acknowledge by
            $table->date('status_as_of_date'); // Status as of date
            $table->string('action_taken'); // Action Taken
            $table->string('concerned_section_personnel'); // Concerned Section / Personnel
            $table->date('deadline_of_compliance'); // Deadline of Compliance
            $table->string('compliance_status'); //, ['Pending', 'Completed', 'In Progress']); // Compliance Status
            $table->string('file_path'); // File path
            $table->string('file_path1'); // File path
            $table->string('file_path2'); // File path
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
