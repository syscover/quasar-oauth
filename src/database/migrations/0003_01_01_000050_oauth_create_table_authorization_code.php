<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OauthCreateTableAuthorizationCode extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('oauth_authorization_code'))
		{
			Schema::create('oauth_authorization_code', function (Blueprint $table) {
				$table->engine = 'InnoDB';

                $table->increments('id');
                $table->uuid('uuid');
                $table->uuid('client_uuid');
                $table->uuid('code');
                $table->boolean('is_revoked')->default(false);
                $table->dateTime('expires_at')->nullable();
                $table->timestamps();

                $table->index('uuid', 'oauth_authorization_code_uuid_idx');
                $table->index('code', 'oauth_authorization_code_code_idx');
                $table->foreign('client_uuid', 'oauth_authorization_code_client_uuid_fk')
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
        Schema::dropIfExists('oauth_authorization_code');
	}
}
