<?php

use App\Models\Category;
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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title' , 250);
            $table->string('author' , 250);
            $table->string('publishers' , 250);
            $table->foreignIdFor(Category::class);
            $table->integer('inventory');
            $table->tinyInteger('status'); // 0 => available 1 => unavailable
            $table->string('pic' , 250)->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
