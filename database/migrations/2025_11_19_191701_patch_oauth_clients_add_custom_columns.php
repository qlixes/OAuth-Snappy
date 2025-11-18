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
        Schema::table("oauth_clients", function (Blueprint $table) {
            $table->ulid("uuid")->after("id");
            $table->text("public_key")->nullable()->after("grant_types");
            $table->text("callback_uris")->nullable()->after("redirect_uris");
            $table->text("phrase")->after("secret");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("oauth_clients", function (Blueprint $table) {
            $table->dropColumn("uuid");
            $table->dropColumn("public_key");
            $table->dropColumn("callback_uris");
            $table->dropColumn("phrase");
        });
    }
};
