<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->integer('pass_id');
            $table->string('fio');
            $table->unique(['pass_id', 'fio']);
        });

        Schema::create('client_phones', function (Blueprint $table) {
            $table->integer('client_id');
            $table->integer('phone');
            $table->unique(['client_id', 'phone']);
            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_phones', function (Blueprint $table) {
            $table->dropForeign('client_phones_client_id_foreign');
        });
        Schema::drop('client_phones');
        Schema::drop('clients');
    }
};
