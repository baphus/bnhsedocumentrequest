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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_id', 10)->unique();
            $table->string('email');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('lrn', 12);
            $table->string('grade_level');
            $table->string('section')->nullable();
            $table->string('track_strand');
            $table->string('school_year_last_attended');
            $table->foreignId('document_type_id')->constrained('documents')->onDelete('cascade');
            $table->text('purpose');
            $table->longText('signature');
            $table->integer('quantity')->default(1);
            $table->enum('status', ['pending', 'processing', 'ready', 'completed'])->default('pending');
            $table->date('estimated_completion_date')->nullable();
            $table->text('admin_remarks')->nullable();
            $table->text('internal_notes')->nullable();
            $table->foreignId('processed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();

            $table->index('tracking_id');
            $table->index('email');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
