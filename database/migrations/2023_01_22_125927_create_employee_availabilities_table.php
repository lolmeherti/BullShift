<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_availabilities', function (Blueprint $table) {
            $table->id();
            $table->integer('user_fid')->unique();
            $table->integer('contract_type_fid');
            $table->string('availability_status');
            $table->decimal('hours_worked_per_day');
            $table->decimal('max_hours_per_day');
            $table->decimal('hours_worked_per_week');
            $table->decimal('max_hours_per_week');
            $table->decimal('hours_worked_this_month');
            $table->decimal('max_hours_this_month');
            $table->integer('days_of_vacation_left');
            $table->integer('max_days_of_vacation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_availabilities');
    }
};
