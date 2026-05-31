<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table): void {
            $table->string('zip_code', 10)->nullable()->after('preferred_contact_method');
            $table->boolean('consent_accepted')->default(false)->after('zip_code');

            $table->index('zip_code');
        });
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table): void {
            $table->dropIndex(['zip_code']);

            $table->dropColumn([
                'zip_code',
                'consent_accepted',
            ]);
        });
    }
};
