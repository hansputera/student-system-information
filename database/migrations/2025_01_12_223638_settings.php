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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('setting_name');

            $table->string('site_name');
            $table->string('site_description');

            $table->string('headmaster_name');
            $table->string('headmaster_id');

            $table->string('dapodik_webservice');
            $table->string('dapodik_webservice_key');

            $table->string('vervalpd_email');
            $table->string('vervalpd_password');

            $table->boolean('active')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
