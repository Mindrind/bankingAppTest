<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('type'); // Consider using an ENUM if you have specific predefined types
            $table->decimal('amount', 15, 2); // For monetary values, precision up to 2 decimal places
            $table->decimal('balance', 15, 2); // Stores the balance after the transaction
            $table->text('description')->nullable(); // To store any additional info about the transaction
            $table->timestamps(); // created_at and updated_at timestamps

            // Setting up the foreign key relationship to the users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // For a transfer transaction, store the receiver's user id
            $table->unsignedBigInteger('destination_user_id')->nullable();
            $table->foreign('destination_user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
