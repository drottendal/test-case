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
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('reference_id');
            $table->string('email');
            $table->string('ssn');
            $table->string('phone');
            $table->string('first_name');
            $table->string('last_name');
            $table->timestamp('dob');
            $table->integer('salary');
            $table->timestamp('employment_from');
            $table->timestamp('employment_to')->nullable();
            $table->boolean('currently_working');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('worker');
    }
};
