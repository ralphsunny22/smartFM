<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('folders', function (Blueprint $table) {
            $table->id();
            $table->string('unique_key');
            $table->string('title');
            $table->string('slug');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('parent_id')->nullable();

            $table->longText('path_by_slug');
            $table->longText('path_by_title');

            $table->string('type')->default('folder'); //will differentiate folder and files in frontend
            
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('folders');
    }
};
