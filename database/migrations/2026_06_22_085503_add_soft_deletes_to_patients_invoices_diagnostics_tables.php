<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Soft deletes stop a deleted doctor/patient/invoice from cascading a
     * hard DELETE through patients, invoices and diagnostics (all three are
     * linked via `onDelete('cascade')` foreign keys). Once these models use
     * SoftDeletes, ->delete() becomes an UPDATE setting deleted_at, so the
     * cascade never fires and medical history is preserved.
     */
    public function up(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('diagnostics', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('diagnostics', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
