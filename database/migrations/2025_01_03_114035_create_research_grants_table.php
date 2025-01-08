<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResearchGrantsTable extends Migration
{
    public function up()
    {
        Schema::create('research_grants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_leader_id')->constrained('academicians');
            $table->decimal('grant_amount', 15, 2);
            $table->string('grant_provider');
            $table->string('project_title');
            $table->date('start_date');
            $table->integer('duration_months');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('research_grants');
    }
}
