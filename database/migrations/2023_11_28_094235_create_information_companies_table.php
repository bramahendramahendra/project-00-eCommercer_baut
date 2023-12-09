<?php

use App\Models\User;
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
        Schema::create('information_companies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('description', 2000)->nullable();
            $table->string('image', 2000)->nullable();
            $table->string('image_mime')->nullable();
            $table->integer('image_size')->nullable();
            $table->string('email');
            $table->string('operating_days');
            $table->string('operating_hours');
            $table->string('phone', 20);
            $table->string('address', 255);
            $table->string('city', 255);
            $table->string('state', 45);
            $table->string('zipcode', 45);
            $table->string('country', 15);
            $table->foreignIdFor(User::class, 'created_by')->nullable();
            $table->foreignIdFor(User::class, 'updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('information_companies');
    }
};
