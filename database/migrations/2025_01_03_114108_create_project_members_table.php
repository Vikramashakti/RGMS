<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectMembersTable extends Migration
{
    public function up()
    {
        Schema::create('project_members', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('research_grant_id')->constrained('research_grants');
            $table->foreignId('academician_id')->constrained('academicians');
            $table->integer('role')->default('1'); // Add role column with default value
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_members');
    }
}

