<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {

		$table->bigIncrements('id')->unsigned();
		$table->bigInteger('conta_id',20)->unsigned();
		$table->string('valor',100);
		$table->string('movimento',100);
		$table->timestamp('created_at')->nullable()->default('NULL');
		$table->timestamp('updated_at')->nullable()->default('NULL');
		$table->primary('id');
		$table->foreign('conta_id')->references('id')->on('banks');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transfers');
    }
}