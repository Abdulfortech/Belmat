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
        Schema::create('election_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('election_id')->nullable()->constrained();
            $table->foreignId('state_id')->nullable()->constrained();
            $table->foreignId('local_government_id')->nullable()->constrained();
            $table->foreignId('ward_id')->nullable()->constrained();
            $table->foreignId('polling_unit_id')->constrained();
            $table->foreignId('election_type_id')->constrained();
            $table->foreignId('political_party_id')->constrained();
            $table->integer('votes');
            $table->text('media')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('election_results');
    }
};
