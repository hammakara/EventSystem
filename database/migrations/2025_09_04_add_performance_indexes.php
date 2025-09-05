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
        Schema::table('events', function (Blueprint $table) {
            $table->index('scheduled_at', 'events_scheduled_at_index');
            $table->index(['organizer_id', 'scheduled_at'], 'events_organizer_scheduled_index');
            $table->index(['venue_id', 'scheduled_at'], 'events_venue_scheduled_index');
            $table->index('title', 'events_title_index');
            $table->index(['scheduled_at', 'organizer_id', 'venue_id'], 'events_dashboard_index');
        });

        Schema::table('attendees', function (Blueprint $table) {
            $table->index('created_at', 'attendees_created_at_index');
            $table->index('name', 'attendees_name_index');
        });

        Schema::table('venues', function (Blueprint $table) {
            $table->index('name', 'venues_name_index');
        });

        Schema::table('organizers', function (Blueprint $table) {
            $table->index('name', 'organizers_name_index');
        });

        Schema::table('vendors', function (Blueprint $table) {
            $table->index('name', 'vendors_name_index');
        });

        // Composite indexes for pivot tables
        Schema::table('attendee_event', function (Blueprint $table) {
            $table->index(['event_id', 'status'], 'attendee_event_status_index');
        });

        Schema::table('event_vendor', function (Blueprint $table) {
            $table->index(['event_id', 'fee'], 'event_vendor_fee_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropIndex('events_scheduled_at_index');
            $table->dropIndex('events_organizer_scheduled_index');
            $table->dropIndex('events_venue_scheduled_index');
            $table->dropIndex('events_title_index');
            $table->dropIndex('events_dashboard_index');
        });

        Schema::table('attendees', function (Blueprint $table) {
            $table->dropIndex('attendees_created_at_index');
            $table->dropIndex('attendees_name_index');
        });

        Schema::table('venues', function (Blueprint $table) {
            $table->dropIndex('venues_name_index');
        });

        Schema::table('organizers', function (Blueprint $table) {
            $table->dropIndex('organizers_name_index');
        });

        Schema::table('vendors', function (Blueprint $table) {
            $table->dropIndex('vendors_name_index');
        });

        Schema::table('attendee_event', function (Blueprint $table) {
            $table->dropIndex('attendee_event_status_index');
        });

        Schema::table('event_vendor', function (Blueprint $table) {
            $table->dropIndex('event_vendor_fee_index');
        });
    }
};
