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
        Schema::create('lead_items', function (Blueprint $table): void {
            $table->id();

            $table->foreignId('lead_id')
                ->constrained('leads')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->string('product_name');
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('price', 12, 2)->nullable();

            $table->timestamps();

            $table->index('lead_id');
            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_items');
    }
};
