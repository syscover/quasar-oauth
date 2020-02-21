<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OauthCreateTableClient extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('oauth_client'))
		{
			Schema::create('oauth_client', function (Blueprint $table) {
				$table->engine = 'InnoDB';

                $table->increments('id');
                $table->uuid('uuid');
                $table->uuid('application_uuid');
                $table->uuid('type_uuid');
                $table->string('name');
                $table->string('secret', 100);
                $table->string('model')->nullable();
                $table->text('redirect');
                $table->boolean('is_revoked');
                $table->boolean('is_master');
                $table->timestamps();

                $table->index('uuid', 'oauth_client_uuid_idx');
                $table->index('type_uuid', 'oauth_client_type_uuid_idx');
                $table->foreign('application_uuid', 'oauth_client_application_uuid_fk')
                    ->references('uuid')
                    ->on('oauth_application')
                    ->onDelete('restrict')
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
        Schema::dropIfExists('oauth_client');
	}
}
