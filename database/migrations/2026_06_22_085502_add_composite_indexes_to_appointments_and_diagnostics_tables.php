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
        // Doctor schedule/calendar lookups filter by doctor_id and range on
        // the appointment datetime — a composite index serves that query
        // pattern directly instead of relying on the doctor_id FK index alone.
        Schema::table('appointments', function (Blueprint $table) {
            $table->index(['doctor_id', 'appointment'], 'appointments_doctor_id_appointment_index');
        });

        // Patient medical history is fetched as "this patient's diagnostics
        // ordered/filtered by date" — index the pair so MySQL can satisfy it
        // without a filesort over the whole table.
        Schema::table('diagnostics', function (Blueprint $table) {
            $table->index(['patient_id', 'date'], 'diagnostics_patient_id_date_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropIndex('appointments_doctor_id_appointment_index');
        });

        Schema::table('diagnostics', function (Blueprint $table) {
            $table->dropIndex('diagnostics_patient_id_date_index');
        });
    }
};
