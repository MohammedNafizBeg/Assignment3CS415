<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_applications', function (Blueprint $table) {
            $table->id();
            // Section A: Personal Details
            $table->unsignedBigInteger('user_id');
            $table->string('student_id_number', 20);
            $table->string('last_name', 100);
            $table->string('first_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('campus', 100)->nullable();
            $table->string('semester_year', 20)->nullable();
            $table->text('address')->nullable();
            $table->string('telephone', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('exam_type', 100)->nullable();
            $table->text('documents', 100)->nullable();
            $table->text('reason_for_apply', 100)->nullable();
            $table->text('missed_exams')->nullable();
            $table->string('status', 20)->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_applications');
    }
}
