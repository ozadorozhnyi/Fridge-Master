<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomainAreaTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('timezone');
            $table->timestamps();
        });

        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id');
            $table->integer('temperature')->default(0);
            $table->timestamps();

            $table->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_id');
            $table->unsignedFloat('current_rent_price')->default(0);
            $table->timestamps();
            $table->foreign('building_id')
                ->references('id')
                ->on('buildings')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('contract_id')->after('id');
            $table->foreign('contract_id')
                ->references('id')
                ->on('contracts')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('location_id');
            $table->char('access_code', 12);
            $table->unsignedInteger('requested_volume');
            $table->smallInteger('requested_temperature');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['reserved', 'progress', 'archived']);
            $table->unsignedFloat('total_costs_on_book_date');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        Schema::create('busy_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('block_id');
            $table->foreignId('booking_id');
            $table->enum('status', ['reserved', 'busy']);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->float('rent_price')->comment('on booking date');
            $table->timestamps();

            $table->foreign('block_id')
                ->references('id')
                ->on('blocks')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('booking_id')
                ->references('id')
                ->on('bookings')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('busy_blocks');
        Schema::dropIfExists('bookings');
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_contract_id_foreign');
            $table->dropColumn('contract_id');
        });
        Schema::dropIfExists('contracts');
        Schema::dropIfExists('blocks');
        Schema::dropIfExists('buildings');
        Schema::dropIfExists('locations');
    }
}
