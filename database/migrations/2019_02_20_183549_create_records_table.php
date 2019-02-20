<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {

            // META
            $table->increments('id');
            $table->uuid('uid');
            $table->timestamp('date_created')->nullable();
            $table->timestamp('date_updated')->nullable();
            $table->timestamp('date_removed')->nullable();

            // DATA
            $table->string('name'); // Наименование
            $table->string('ogrn')->nullable(); // ОГРН
            $table->string('inn')->nullable(); // ИНН
            $table->string('cpp')->nullable(); // КПП
            $table->string('address')->nullable(); // Адрес
            $table->string('director')->nullable(); // Руководитель (ФИО)

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
