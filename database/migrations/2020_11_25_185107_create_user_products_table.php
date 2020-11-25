<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('user_products', function (Blueprint $table) {
            $table->id();
            $table->string('nickname', 280)->nullable();
            $table->text('description')->nullable();
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->string('sku')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('category')->nullable();
            $table->string('location')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('no action');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('no action');
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
        Schema::dropIfExists('user_products');
    }
}
