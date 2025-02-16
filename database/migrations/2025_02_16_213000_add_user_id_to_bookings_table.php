<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToBookingsTable extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Aggiungi la colonna user_id (nullable se non tutti i booking sono associati a un utente)
            $table->unsignedBigInteger('user_id')->nullable()->after('id');

            // Opzionale: se vuoi creare una foreign key che riferisca la tabella users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Prima rimuovi la foreign key, poi la colonna
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
