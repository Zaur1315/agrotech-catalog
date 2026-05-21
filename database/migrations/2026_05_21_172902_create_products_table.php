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
        Schema::create('products', function (Blueprint $table): void {
            $table->id();

            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('brand_id')
                ->nullable()
                ->constrained('brands')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->nullable()->unique();

            $table->string('short_description')->nullable();
            $table->longText('description')->nullable();

            $table->decimal('price', 12, 2)->nullable();
            $table->boolean('price_on_request')->default(false);

            $table->unsignedSmallInteger('year')->nullable();
            $table->string('condition')->nullable();
            $table->string('engine')->nullable();
            $table->string('transmission')->nullable();
            $table->string('fuel_type')->nullable();
            $table->unsignedInteger('hours_used')->nullable();

            $table->string('main_image')->nullable();

            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index(['category_id', 'is_active']);
            $table->index(['brand_id', 'is_active']);
            $table->index(['is_featured', 'is_active']);
            $table->index(['price']);
            $table->index(['year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
