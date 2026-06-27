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
        // MySQL needs a covering index on doctor_id for the FK before the
        // old unique index (which currently provides it) can be dropped.
        Schema::table('doctor_slots', function (Blueprint $table) {
            $table->index('doctor_id');
        });

        Schema::table('doctor_slots', function (Blueprint $table) {
            $table->dropUnique(['doctor_id', 'start_time']);
            $table->string('day_of_week')->after('doctor_id');
            $table->unique(['doctor_id', 'day_of_week', 'start_time']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctor_slots', function (Blueprint $table) {
            $table->dropUnique(['doctor_id', 'day_of_week', 'start_time']);
            $table->dropColumn('day_of_week');
            $table->unique(['doctor_id', 'start_time']);
        });

        Schema::table('doctor_slots', function (Blueprint $table) {
            $table->dropIndex(['doctor_id']);
        });
    }
};
