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
        Schema::create('my_files', function (Blueprint $table) {
            $table->id();
            $table->string('unique_key');
            $table->string('title');
            $table->string('original_name')->nullable(); //on updating
            $table->string('size')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->string('type'); //pdf, xlx, doc, jpg, png ////will differentiate folder and files in frontend
            $table->unsignedBigInteger('folder_id');
            
            $table->unsignedBigInteger('downloads_count')->default(0);
            $table->unsignedBigInteger('views_count')->default(0);
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
        Schema::dropIfExists('my_files');
    }
};
