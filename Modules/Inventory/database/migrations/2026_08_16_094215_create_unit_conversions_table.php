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
    Schema::create('unit_conversions', function (Blueprint $table) {
        $table->id();

        $table->foreignId('company_id')
            ->constrained('companies')
            ->cascadeOnDelete();

        $table->foreignId('from_unit_id')
            ->constrained('units')
            ->restrictOnDelete();

        $table->foreignId('to_unit_id')
            ->constrained('units')
            ->restrictOnDelete();

        $table->decimal('factor', 20, 10);

        $table->unique([
            'company_id',
            'from_unit_id',
            'to_unit_id',
        ]);

        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_conversions');
    }
};
