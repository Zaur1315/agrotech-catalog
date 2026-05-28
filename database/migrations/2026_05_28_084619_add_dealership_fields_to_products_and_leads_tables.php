<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table): void {
            $table->string('stock_number')->nullable()->after('sku');
            $table->string('serial_number')->nullable()->after('stock_number');
            $table->unsignedSmallInteger('horsepower')->nullable()->after('hours_used');
            $table->string('drive_type')->nullable()->after('horsepower');
            $table->string('location')->nullable()->after('main_image');
            $table->string('status')->default('available')->after('location');
            $table->unsignedInteger('sort_order')->default(0)->after('status');

            $table->index('stock_number');
            $table->index(['status', 'is_active']);
            $table->index(['sort_order', 'is_active']);
        });

        Schema::table('leads', function (Blueprint $table): void {
            $table->string('type')->default('general')->after('id');
            $table->string('preferred_contact_method')->nullable()->after('phone');
            $table->string('source_page')->nullable()->after('source');

            $table->string('utm_source')->nullable()->after('source_page');
            $table->string('utm_medium')->nullable()->after('utm_source');
            $table->string('utm_campaign')->nullable()->after('utm_medium');
            $table->string('utm_content')->nullable()->after('utm_campaign');
            $table->string('utm_term')->nullable()->after('utm_content');

            $table->string('fbp')->nullable()->after('utm_term');
            $table->string('fbc')->nullable()->after('fbp');

            $table->string('ip_address', 45)->nullable()->after('fbc');
            $table->text('user_agent')->nullable()->after('ip_address');

            $table->index('type');
            $table->index(['type', 'status']);
        });
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table): void {
            $table->dropIndex(['type']);
            $table->dropIndex(['type', 'status']);

            $table->dropColumn([
                'type',
                'preferred_contact_method',
                'source_page',
                'utm_source',
                'utm_medium',
                'utm_campaign',
                'utm_content',
                'utm_term',
                'fbp',
                'fbc',
                'ip_address',
                'user_agent',
            ]);
        });

        Schema::table('products', function (Blueprint $table): void {
            $table->dropIndex(['stock_number']);
            $table->dropIndex(['status', 'is_active']);
            $table->dropIndex(['sort_order', 'is_active']);

            $table->dropColumn([
                'stock_number',
                'serial_number',
                'horsepower',
                'drive_type',
                'location',
                'status',
                'sort_order',
            ]);
        });
    }
};
