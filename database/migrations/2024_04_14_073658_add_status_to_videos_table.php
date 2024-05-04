<?php

use App\Enums\videostatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('videos', function (Blueprint $table) {
            // Convertit les valeurs des différents status en un tableau à passer dans le champ status de la table videos
            $statusValues = array_column(videostatus::cases(), 'value');
            $table->enum('status', $statusValues)->after('url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
