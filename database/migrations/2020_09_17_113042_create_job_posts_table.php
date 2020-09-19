<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->string('job_title', 50);
            $table->decimal('salary', 11, 2);
            $table->string('location', 50)->nullable();
            $table->string('country', 20);
            $table->text('job_description');
            $table->enum('status', ['1', '0'])->default('1')->comment('1 is active, 0 is in-active');
            $table->timestamps();

            //for foreign key
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_posts');
    }
}
