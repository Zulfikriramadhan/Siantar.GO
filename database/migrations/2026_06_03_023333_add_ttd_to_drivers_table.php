<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->text('ttd_driver')->nullable()->after('status_verifikasi');
            $table->text('ttd_admin')->nullable()->after('ttd_driver');
        });
    }

    public function down(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn(['ttd_driver', 'ttd_admin']);
        });
    }
};
