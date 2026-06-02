<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\Schema;

   return new class extends Migration
   {
       public function up(): void
       {
           Schema::table('drivers', function (Blueprint $table) {
               $table->string('tipe_kendaraan')->nullable()->after('jenis_kendaraan');
               $table->string('foto_stnk')->nullable()->after('foto_sim');
           });
       }

       public function down(): void
       {
           Schema::table('drivers', function (Blueprint $table) {
               $table->dropColumn(['tipe_kendaraan', 'foto_stnk']);
           });
       }
   };
