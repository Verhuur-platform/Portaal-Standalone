<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateLokaalsTable
 */
class CreateLokaalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lokalen', function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('verantwoordelijke_id')->nullable();
            $table->string('naam');
            $table->string('aantal_personen')->nullable();
            $table->timestamps();

            // Foreign key indexes
            $table->foreign('verantwoordelijke_id')->references('id')->on('users')->ondelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('lokalen');
    }
}
