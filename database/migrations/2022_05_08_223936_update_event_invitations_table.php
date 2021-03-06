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
        Schema::table('event_invitations', function (Blueprint $table) {
            // $table->renameColumn('owner_id', 'event_id');
            $table->foreign('event_id')
                ->references('id')->on('events')
                ->onDelete('cascade');
            $table->foreign('guest_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_invitations', function (Blueprint $table) {
            //
        });
    }
};
