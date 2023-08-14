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
        Schema::create('employees', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id');
            $table->string('code')->comment('Employee number or code');
            $table->string("first_name");
            $table->string("last_name");
            $table->string("display_name");
            $table->timestamps();


            $table->primary(['company_id', 'code']);
            $table->foreign('company_id')->references('id')->on('companies')->index('employee_company_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
