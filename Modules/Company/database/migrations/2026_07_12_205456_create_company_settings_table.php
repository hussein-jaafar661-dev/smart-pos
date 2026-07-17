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
        Schema::create('company_settings', function (Blueprint $table) {
            $table->id();
                    // Company Relation
            $table->foreignId('company_id')
                ->unique()
                ->constrained()
                ->cascadeOnDelete();

            // Localization
            $table->string('language', 10)->default('en');
            $table->string('timezone')->default('UTC');
            $table->string('currency_code', 10)->default('USD');
            $table->string('currency_symbol', 10)->default('$');
            $table->unsignedTinyInteger('decimal_places')->default(2);
            $table->string('date_format')->default('Y-m-d');
            $table->string('time_format')->default('H:i');

            // Branding
            $table->string('favicon')->nullable();

           

            // Legal
          //  $table->string('tax_number')->nullable();
            // $table->string('commercial_register')->nullable();

            // Invoice
            $table->text('invoice_footer')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_settings');
    }
};
