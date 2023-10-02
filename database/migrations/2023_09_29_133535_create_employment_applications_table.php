<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employment_applications', function (Blueprint $table) {
            $table->id();
            $table->string('gender');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('city');
            $table->date('birthday');
            $table->string('phone')->unique();
            $table->string('email')->unique();

            /////// Experience
            $table->string('title');
            $table->string('company_name')->nullable();
            $table->string('office_location')->nullable();
            $table->longText('description')->nullable();
            $table->date('start_date');
            $table->date('expire_date');
            $table->boolean('i_currently_work_here')->default(false);
            $table->string('resume');
            $table->longText('message')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_applications');
    }
};
