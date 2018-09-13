<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConfigsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ck_configs', function(Blueprint $table)
		{
			$table->increments('id')->comment('主键');
			$table->string('name', 100)->default('')->comment('配置项键名');
			$table->text('value')->comment('配置项键值');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('ck_configs');
	}

}
