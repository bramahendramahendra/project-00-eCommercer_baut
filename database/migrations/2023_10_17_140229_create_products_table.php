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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->references('id')->on('types');
            $table->bigInteger('code');
            $table->string('title', 2000);
            $table->string('slug', 2000);
            $table->string('image', 2000)->nullable();
            $table->string('image_mime')->nullable();
            $table->integer('image_size')->nullable();
            $table->string('description')->nullable();
            $table->decimal('price_retail', 10, 2);
            $table->decimal('price_wholesale', 10, 2);
            $table->integer('quantity_limit');
            $table->foreignId('unit_id')->references('id')->on('units');
            $table->foreignId('material_id')->references('id')->on('materials');
            $table->decimal('weight', 4, 2)->nullable();
            $table->foreignId('unit_weight_id')->references('id')->on('units')->nullable();
            $table->integer('contents_per_box')->nullable();
            $table->foreignId('unit_contents_per_box_id')->references('id')->on('units')->nullable();
            $table->decimal('grade', 4, 2)->nullable();
            $table->foreignId('thread_direction_id')->references('id')->on('thread_directions')->nullable();
            $table->foreignId('thread_density_id')->references('id')->on('thread_densities')->nullable();
            $table->decimal('diameter', 4, 2)->nullable();
            $table->decimal('inner_diameter', 4, 2)->nullable();
            $table->decimal('outer_diameter', 4, 2)->nullable();
            $table->foreignId('unit_diameter_id')->references('id')->on('units')->nullable();
            $table->decimal('length', 4, 2)->nullable();
            $table->foreignId('unit_length_id')->references('id')->on('units')->nullable();
            $table->string('drat_size', 10)->nullable();
            $table->string('dimensional_standart', 20)->nullable();
            $table->string('head_style', 20)->nullable();
            $table->string('drive_type', 20)->nullable();
            $table->decimal('thick_head', 4, 2)->nullable();
            $table->foreignId('unit_thick_head_id')->references('id')->on('units')->nullable();
            $table->string('across_flats', 20)->nullable();
            $table->string('drat_type', 20)->nullable();
            $table->decimal('drat_length', 4, 2)->nullable();
            $table->foreignId('unit_drat_length_id')->references('id')->on('units')->nullable();
            $table->foreignId('color_id')->references('id')->on('colors');
            $table->foreignIdFor(User::class, 'created_by')->nullable();
            $table->foreignIdFor(User::class, 'updated_by')->nullable();
            $table->foreignIdFor(User::class, 'deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
