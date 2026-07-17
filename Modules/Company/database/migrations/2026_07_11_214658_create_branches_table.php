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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name',150);
            $table->foreignId('company_id')
                ->constrained()
                ->cascadeOnDelete();
                  $table->string('code',20)->unique();
            $table->string('phone',30)->nullable();
            $table->string('email',150)->nullable();
            $table->string('address',150)->nullable();
            $table->string('city',50)->nullable();
            $table->string('state',50)->nullable();
            $table->string('country',50)->nullable();
            $table->string('postal_code',20)->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_main')->default(false);
            $table->text('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
