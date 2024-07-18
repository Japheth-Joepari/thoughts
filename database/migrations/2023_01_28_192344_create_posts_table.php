<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name')->unique();
            $table->text('description');
            $table->string('description_hash')->unique();
            $table->string('image')->nullable();
            $table->string('image_public_id')->nullable();
            $table->timestamps();
        });

        // Create a trigger to automatically fill the description_hash field
        DB::unprepared('
            CREATE TRIGGER before_insert_posts
            BEFORE INSERT ON posts FOR EACH ROW
            SET NEW.description_hash = MD5(NEW.description);
        ');

        DB::unprepared('
            CREATE TRIGGER before_update_posts
            BEFORE UPDATE ON posts FOR EACH ROW
            SET NEW.description_hash = MD5(NEW.description);
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop the triggers
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_posts');
        DB::unprepared('DROP TRIGGER IF EXISTS before_update_posts');

        Schema::dropIfExists('posts');
    }
};
