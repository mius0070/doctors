<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateEntetesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entetes', function (Blueprint $table) {
            $table->id();
            $table->string('code_etablissement');
            $table->string('titre');
            $table->string('desc')->nullable();
            $table->string('adresse')->nullable();
            $table->tinyInteger('wilaya');
            $table->string('phone',10);
            $table->string('fax',10);
            $table->string('email')->nullable();
            $table->string('logo');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entetes');
    }
}
