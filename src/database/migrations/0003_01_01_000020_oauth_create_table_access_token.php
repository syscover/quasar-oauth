<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OauthCreateTableAccessToken extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('oauth_access_token'))
		{
			Schema::create('oauth_access_token', function (Blueprint $table) {
				$table->engine = 'InnoDB';

                $table->increments('id');
                $table->uuid('uuid');
                $table->uuid('client_uuid');
                $table->text('token');
                $table->boolean('is_revoked');
                $table->string('name')->nullable();
                $table->uuid('user_uuid')->nullable();
                $table->string('user_type')->nullable();
                $table->dateTime('expires_at')->nullable();
                $table->timestamps();
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
        Schema::dropIfExists('oauth_access_token');
	}
}
