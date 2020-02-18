<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OauthCreateTableRefreshToken extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('oauth_refresh_token'))
		{
			Schema::create('oauth_refresh_token', function (Blueprint $table) {
				$table->engine = 'InnoDB';

                $table->increments('id');
                $table->uuid('uuid');
                $table->uuid('access_token_uuid');
                $table->text('token');
                $table->boolean('is_revoked');
                $table->dateTime('expires_at')->nullable();
                $table->timestamps();

                $table->index('uuid', 'oauth_refresh_token_uuid_idx');
                $table->foreign('access_token_uuid', 'oauth_refresh_token_access_token_uuid_fk')
                    ->references('uuid')
                    ->on('oauth_access_token')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
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
