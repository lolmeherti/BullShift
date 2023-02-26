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
        Schema::create('employees', function (Blueprint $table) {
            $table->id()->index();
            $table->tinyInteger('user_fid')->index();
            $table->tinyInteger('contract_type_fid')->index();
            $table->tinyInteger('designation_fid')->index();
            $table->tinyInteger('department_fid')->nullable();
            $table->decimal('wage_per_year')->nullable();
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
        Schema::dropIfExists('employees');
    }
};
