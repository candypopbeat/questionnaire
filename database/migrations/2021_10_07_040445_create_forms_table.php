<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('forms', function (Blueprint $table) {
			$table->id();
			$table->string('gender', 1)->comment("性別");
			$table->string('age', 5)->nullable()->comment("年代");
			$table->string('pref', 4)->comment("都道府県");
			$table->string('facilitys', 100)->comment("施設");
			$table->string('author', 20)->nullable()->comment("ログイン中のユーザーか、一般のお客様");
			$table->string('userIp', 50)->nullable()->comment("投稿者のIPアドレス");
			$table->string('userAgent', 150)->nullable()->comment("投稿者のエージェント");
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('forms');
	}
}
