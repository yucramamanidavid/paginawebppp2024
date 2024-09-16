<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('student_companies', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('acceptance_reason');
            $table->string('location');
            $table->string('contact');
            $table->text('additional_info')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_companies');
    }
};
