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
        // Add missing indexes for foreign keys
        Schema::table('request_logs', function (Blueprint $table) {
            $table->index('user_id');
        });

        Schema::table('requests', function (Blueprint $table) {
            $table->index('document_type_id');
            $table->index('processed_by');
            
            // Drop redundant index (tracking_id has a unique index already)
            $table->dropIndex('requests_tracking_id_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('request_logs', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
        });

        Schema::table('requests', function (Blueprint $table) {
            $table->dropIndex(['document_type_id']);
            $table->dropIndex(['processed_by']);
            
            // Restore redundant index if needed
            $table->index('tracking_id');
        });
    }
};
