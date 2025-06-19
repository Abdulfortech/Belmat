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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('agent_name')->nullable();
            $table->string('agent_phone')->nullable();
            $table->string('media')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('no action');
            $table->foreignId('election_id')->nullable()->constrained()->onDelete('no action');
            $table->string('election_type')->nullable();
            $table->foreignId('political_party_id')->nullable()->constrained()->onDelete('no action');
            $table->foreignId('state_id')->nullable()->constrained()->onDelete('no action');
            $table->foreignId('local_government_id')->nullable()->constrained()->onDelete('no action');
            $table->foreignId('ward_id')->nullable()->constrained()->onDelete('no action');
            $table->foreignId('polling_unit_id')->nullable()->constrained()->onDelete('no action');
            $table->string('constituency_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
