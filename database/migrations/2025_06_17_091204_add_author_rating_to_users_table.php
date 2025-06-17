<?php

// database/migrations/YYYY_MM_DD_add_author_rating_to_users_table.php

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
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('average_rating', 2, 1)->default(0.0)->after('email')->nullable(); // Contoh: 4.5
            $table->integer('ratings_count')->default(0)->after('average_rating')->nullable(); // Jumlah total rating
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['average_rating', 'ratings_count']);
        });
    }
};
