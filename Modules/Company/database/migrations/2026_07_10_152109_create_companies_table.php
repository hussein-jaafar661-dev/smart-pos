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
        Schema::create('companies', function (Blueprint $table) {
      $table->id();

$table->string('code',20)->unique();

$table->string('name',150);

$table->string('legal_name',150)->nullable();

$table->string('tax_number',50)->nullable()->unique();
            $table->string('commercial_register')->nullable();
$table->foreignId('business_type_id')->constrained()->restrictOnDelete();
$table->string('email',150)->nullable();

$table->string('phone',50)->nullable();

$table->string('website',150)->nullable();

$table->string('logo',150)->nullable();

$table->string('address',150)->nullable();

$table->string('city',50)->nullable();

$table->string('state',50)->nullable();

$table->string('country',50)->nullable();

$table->string('postal_code',20)->nullable();

$table->boolean('is_active')->default(true);

$table->timestamps();

$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
