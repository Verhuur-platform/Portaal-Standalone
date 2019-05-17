<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateLeasesTable
 */
class CreateLeasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('leases', function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('successor_id')->nullable();
            $table->integer('persons');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();

            // Foreign keys
            $table->foreign('successor_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('status_id')->references('id')->on('statuses')->ondelete('set null');
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('leases');
    }
}
