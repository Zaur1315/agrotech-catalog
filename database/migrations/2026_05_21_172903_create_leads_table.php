<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table): void {
            $table->id();

            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('subject')->nullable();
            $table->text('message')->nullable();

            $table->string('status')->default('new');
            $table->string('source')->default('website');

            $table->timestamps();

            $table->index('status');
            $table->index('source');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
