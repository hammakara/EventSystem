<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('image')->nullable()->after('venue_id');
        });
        Schema::table('venues', function (Blueprint $table) {
            $table->string('image')->nullable()->after('owner');
        });
        Schema::table('vendors', function (Blueprint $table) {
            $table->string('image')->nullable()->after('details');
        });
        Schema::table('organizers', function (Blueprint $table) {
            $table->string('image')->nullable()->after('role');
        });
        Schema::table('attendees', function (Blueprint $table) {
            $table->string('image')->nullable()->after('preferences');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) { $table->dropColumn('image'); });
        Schema::table('venues', function (Blueprint $table) { $table->dropColumn('image'); });
        Schema::table('vendors', function (Blueprint $table) { $table->dropColumn('image'); });
        Schema::table('organizers', function (Blueprint $table) { $table->dropColumn('image'); });
        Schema::table('attendees', function (Blueprint $table) { $table->dropColumn('image'); });
    }
};
