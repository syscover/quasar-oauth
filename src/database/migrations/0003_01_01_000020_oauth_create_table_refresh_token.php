<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminCreateTableLang extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('oauth_refresh_token'))
		{
			Schema::create('oauth_refresh_token', function (Blueprint $table) {
				$table->engine = 'InnoDB';

                $table->increments('id');
                $table->uuid('uuid');
                $table->uuid('access_token_uuid');
                $table->text('token');
                $table->boolean('is_revoked');
                $table->userUuid('uuid');
                $table->userType('uuid');
                $table->timestamps();
                $table->dateTime('expires_at')->nullable();
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
        Schema::dropIfExists('oauth_refresh_token');
	}
}
