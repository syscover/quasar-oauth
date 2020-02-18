<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OauthCreateTableApplication extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('oauth_application'))
		{
			Schema::create('oauth_application', function (Blueprint $table) {
				$table->engine = 'InnoDB';

                $table->increments('id');
                $table->uuid('uuid');
                $table->string('code');
                $table->string('secret');
                $table->string('name');
                $table->string('model');
                $table->timestamps();

                $table->index('uuid', 'oauth_application_uuid_idx');
                $table->unique('code', 'oauth_application_code_uq');
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('oauth_application');
	}
}
