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
             $table->string('country_code')->nullable()->after('password');
            $table->string('mobile')->unique()->nullable()->after('country_code');
            $table->string('otp')->nullable()->after('mobile');
            $table->timestamp('otp_expires_at')->nullable()->after('otp');
            $table->string('lat')->nullable()->after('otp_expires_at');
            $table->string('long')->nullable()->after('lat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'country_code',
                'mobile',
                'otp',
                'otp_expires_at',
                'lat',
                'long',
            ]);
        });
    }
};
