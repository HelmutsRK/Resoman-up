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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->unsignedBigInteger('employee_type_id')->nullable();
            $table->foreign('employee_type_id')
                ->references('id')
                ->on('employee_types')
                ->nullOnDelete();

            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')
                ->references('id')
                ->on('departments')
                ->nullOnDelete();

            $table->unsignedBigInteger('position_id')->nullable();
            $table->foreign('position_id')
                ->references('id')
                ->on('positions')
                ->nullOnDelete();

            $table->date('first_day_of_work')->nullable();
            $table->string('phone')->nullable();
            $table->decimal('cost_rate')->nullable();
            $table->decimal('bill_rate')->nullable();
            $table->integer('utilization_target')->default(100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
