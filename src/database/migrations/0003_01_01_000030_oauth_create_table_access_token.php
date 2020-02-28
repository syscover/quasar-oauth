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
		if (!Schema::hasTable('oauth_access_token'))
		{
			Schema::create('oauth_access_token', function (Blueprint $table) {
				$table->engine = 'InnoDB';

                $table->increments('id');
                $table->uuid('uuid');
                $table->uuid('client_uuid');
                $table->text('token');
                $table->string('name')->nullable();
                $table->string('user_type')->nullable();
                $table->uuid('user_uuid')->nullable();
                $table->boolean('is_revoked')->default(false);
                $table->dateTime('expires_at')->nullable();
                $table->timestamps();

                $table->index('uuid', 'oauth_access_token_uuid_idx');
                $table->foreign('client_uuid', 'oauth_access_token_client_uuid_fk')
                    ->references('uuid')
                    ->on('oauth_client')
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
        Schema::dropIfExists('oauth_access_token');
	}
}
