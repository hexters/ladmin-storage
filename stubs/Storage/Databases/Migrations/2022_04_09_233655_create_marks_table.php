<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Storage\Models\Mark;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('ladmin_storage_marks', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('parent_id')
                ->foreignIdFor(Mark::class)
                ->nullable();
            $table->foreignId('user_id');
            $table->text('base_path')->nullable();
            $table->text('file_path')->fulltext()->nullable();
            $table->string('body')->nullable();
            $table->string('type')->nullable();
            $table->string('state')->nullable();
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('ladmin_storage_marks');
        Schema::enableForeignKeyConstraints();
    }
};
