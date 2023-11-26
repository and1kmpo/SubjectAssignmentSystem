<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessorSubjectTable extends Migration
{
    public function up()
    {
        Schema::create('professor_subject', function (Blueprint $table) {
            $table->id();
            $table->foreignId('professor_id')->constrained();
            $table->foreignId('subject_id')->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('professor_subject');
    }
}