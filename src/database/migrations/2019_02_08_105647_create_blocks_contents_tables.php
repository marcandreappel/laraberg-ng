<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlocksContentsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('editor_blocks', function (Blueprint $table) {
            $table->uuid('id')->index()->unique()->primary();
            $table->string('raw_title')->nullable();
            $table->text('raw_content')->nullable();
            $table->text('rendered_content')->nullable();
            $table->string('status');
            $table->string('slug');
            $table->string('type')->default('wp_block');
            $table->timestamps();
        });

        Schema::create('editor_contents', function (Blueprint $table) {
            $table->uuid('id')->index()->primary()->unique();
            $table->text('raw_content')->nullable();
            $table->text('rendered_content')->nullable();
            $table->uuidMorphs('model');
            $table->string('type')->default('page');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('editor_blocks');
        Schema::drop('editor_contents');
    }
}

