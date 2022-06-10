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
        Schema::create('cargo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cargo_no');
            $table->string('cargo_type');
            $table->bigInteger('cargo_size');
            $table->double('weight', 0.00);
            $table->string('remarks')->nullable();
            $table->double('wharfage', 0.00);
            $table->bigInteger('penalty', 0);
            $table->double('storage', 0.00);
            $table->double('electricity', 0.00);
            $table->double('destuffing', 0);
            $table->double('lifting', 0);
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
        Schema::dropIfExists('cargo');
    }
};
