<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_company_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('Pending');
            $table->text('feedback')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('company_reviews');
    }
}
