<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableConstraintToUserInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_informations', function (Blueprint $table) {
            $table->smallInteger('gender')->nullable()->change();
            $table->date('date_of_birth')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('phone')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_informations', function (Blueprint $table) {
            $table->smallInteger('gender')->nullable(false)->change();
            $table->date('date_of_birth')->nullable(false)->change();
            $table->string('address')->nullable(false)->change();
            $table->string('phone')->nullable(false)->change();
        });
    }
}
