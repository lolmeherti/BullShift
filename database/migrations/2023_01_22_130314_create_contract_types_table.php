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
    public function up(): void
    {
        Schema::create('contract_types', function (Blueprint $table) {
            $table->id()->index();
            $table->integer('user_fid')->index();
            $table->string('contract_type');
            $table->decimal('min_hours_per_shift');
            $table->decimal('max_hours_per_week');
            $table->integer('break_length_in_minutes');
            $table->string('break_included');
            $table->integer('days_of_vacation_per_year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_types');
    }
};
