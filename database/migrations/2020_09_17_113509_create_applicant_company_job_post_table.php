<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantCompanyJobPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_job_post', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('applicant_id');
            $table->unsignedBigInteger('job_post_id');
            $table->timestamps();

            //for foreign key
            $table->foreign('applicant_id')->references('id')->on('applicants')->onDelete('restrict');
            $table->foreign('job_post_id')->references('id')->on('job_posts')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicant_company_job_post');
    }
}
