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
    Schema::table('users', function (Blueprint $table) {

       $table->foreignId('company_id')
    ->nullable()
    ->constrained('companies')
    ->cascadeOnUpdate()
    ->restrictOnDelete();

$table->foreignId('branch_id')
    ->nullable()
    ->constrained('branches')
    ->cascadeOnUpdate()
    ->restrictOnDelete();

        $table->string('username')
            ->after('name')
            ->unique();

        $table->string('phone')
            ->nullable()
            ->after('email');

        $table->boolean('is_active')
            ->default(true)
            ->after('password');

        $table->timestamp('last_login_at')
            ->nullable()
            ->after('is_active');

        $table->softDeletes();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('', function (Blueprint $table) {
            
        });
    }
};
