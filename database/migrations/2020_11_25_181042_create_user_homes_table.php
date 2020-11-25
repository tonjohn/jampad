<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserHomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('user_homes', function (Blueprint $table) {
            $table->id();
            $table->string('nickname', 280);
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->char('state', 2)->nullable();
            $table->string('zip')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users', 'by')->onDelete('no action');
            $table->foreignId('updated_by')->nullable()->constrained('users', 'by')->onDelete('no action');
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
        Schema::dropIfExists('user_homes');
    }
}
