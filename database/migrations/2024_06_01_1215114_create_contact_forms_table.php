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
        Schema::create('contact_forms', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('address');
            $table->string('email');
            $table->string('service');
            $table->string('object');
            $table->text('note');
            $table->timestamps();
        });

        Schema::create('contact_commercial', function (Blueprint $table) {
            $table->id();
            $table->string('nom_entreprise');
            $table->string('email');
            $table->string('telephone');
            $table->string('nom_responsable');
            $table->string('rue');
            $table->string('unite');
            $table->string('ville');
            $table->string('province');
            $table->string('code_postal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_forms');
        Schema::dropIfExists('contact_commercial');
    }
};