<?php

use App\Models\User;
use App\Models\MasterCity;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('official_travel', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('departure_date');
            $table->string('return_date');
            $table->foreignIdFor(MasterCity::class, 'hometown_id')->nullable();
            $table->foreign('hometown_id')->references('id')->on('master_cities')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignIdFor(MasterCity::class, 'destination_id')->nullable();
            $table->foreign('destination_id')->references('id')->on('master_cities')->onUpdate('cascade')->onDelete('cascade');
            $table->string('duration')->nullable();
            $table->longText('description');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('official_travel');
    }
};
